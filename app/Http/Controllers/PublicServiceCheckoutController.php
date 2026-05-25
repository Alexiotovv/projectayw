<?php

namespace App\Http\Controllers;

use App\Mail\PlanPurchaseConfirmation;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\ServicePlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class PublicServiceCheckoutController extends Controller
{
    public function create(ServicePlan $servicePlan)
    {
        abort_unless($servicePlan->is_active, 404);

        $paymentMethods = PaymentMethod::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('public.services.checkout', compact('servicePlan', 'paymentMethods'));
    }

    public function store(Request $request, ServicePlan $servicePlan)
    {
        abort_unless($servicePlan->is_active, 404);

        $accountMode = $request->input('account_mode', 'register');

        $rules = [
            'account_mode' => ['required', 'in:register,login'],
            'service_name' => ['required', 'string', 'max:255'],
            'domain' => ['nullable', 'string', 'max:255'],
            'payment_method_id' => [
                'required',
                Rule::exists('payment_methods', 'id')->where(fn ($q) => $q->where('is_active', true)),
            ],
            'auto_renew' => ['nullable', 'boolean'],
            'terms' => ['accepted'],
        ];

        if ($accountMode === 'register') {
            $rules = array_merge($rules, [
                'name' => ['required', 'string', 'max:255'],
                'company' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20'],
                'email' => ['required', 'string', 'email', 'max:255', 'confirmed', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } else {
            $rules = array_merge($rules, [
                'login_email' => ['required', 'string', 'email', 'max:255'],
                'login_password' => ['required', 'string'],
            ]);
        }

        $validated = $request->validate($rules);

        $paymentMethod = PaymentMethod::query()
            ->where('id', $validated['payment_method_id'])
            ->where('is_active', true)
            ->firstOrFail();

        if ($accountMode === 'login') {
            if (!Auth::attempt([
                'email' => $validated['login_email'],
                'password' => $validated['login_password'],
            ])) {
                return back()
                    ->withErrors(new MessageBag(['login_email' => 'Las credenciales no coinciden.']))
                    ->withInput();
            }

            $request->session()->regenerate();
            $authUser = Auth::user();

            if ($authUser->hasAnyRole(['superadmin', 'admin'])) {
                Auth::logout();
                return back()
                    ->withErrors(new MessageBag(['login_email' => 'No puedes contratar servicios con una cuenta administrativa.']))
                    ->withInput();
            }
        }

        $result = DB::transaction(function () use ($validated, $servicePlan, $paymentMethod, $request, $accountMode) {
            if ($accountMode === 'register') {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'company' => $validated['company'],
                    'phone' => $validated['phone'],
                ]);

                $user->assignRole('customer');
            } else {
                $user = Auth::user();

                if (!$user->hasRole('customer')) {
                    $user->assignRole('customer');
                }
            }

            $startDate = Carbon::now();
            $expiryDate = $servicePlan->billing_cycle === 'yearly'
                ? $startDate->copy()->addYear()
                : $startDate->copy()->addMonth();

            $service = $user->services()->create([
                'service_plan_id' => $servicePlan->id,
                'name' => $validated['service_name'],
                'type' => $this->mapPlanTypeToServiceType($servicePlan->type),
                'domain' => $validated['domain'] ?? null,
                'plan' => $servicePlan->name,
                'features' => $servicePlan->features,
                'email_accounts' => $servicePlan->type === 'email' ? 10 : 0,
                'storage_gb' => $servicePlan->type === 'vps' ? 100 : 20,
                'status' => 'pending',
                'start_date' => $startDate,
                'expiry_date' => $expiryDate,
                'auto_renew' => $request->boolean('auto_renew', true),
            ]);

            $payment = $user->payments()->create([
                'service_id' => $service->id,
                'amount' => $servicePlan->price,
                'currency' => 'PEN',
                'payment_method' => $paymentMethod->code,
                'status' => Payment::STATUS_PENDING,
                'payment_date' => $startDate,
                'due_date' => $startDate->copy()->addDays(3),
                'notes' => 'Pago generado automáticamente por compra pública: ' . $servicePlan->name,
            ]);

            return compact('user', 'service', 'payment');
        });

        try {
            Mail::to($result['user']->email)->send(new PlanPurchaseConfirmation(
                $result['user'],
                $servicePlan,
                $result['service'],
                $result['payment'],
                $paymentMethod
            ));
        } catch (\Throwable $e) {
            Log::error('No se pudo enviar correo de confirmación de compra', [
                'user_id' => $result['user']->id,
                'email' => $result['user']->email,
                'error' => $e->getMessage(),
            ]);
        }

        Auth::login($result['user']);

        return redirect()
            ->route('customer.payments.show', $result['payment']->id)
            ->with('success', 'Registro y solicitud completados. Te enviamos un correo de confirmación con el resumen.');
    }

    private function mapPlanTypeToServiceType(string $planType): string
    {
        return match ($planType) {
            'vps', 'hosting', 'web-hosting' => 'hosting',
            'domain' => 'domain',
            'email', 'email-corporate' => 'email',
            default => 'saas',
        };
    }
}
