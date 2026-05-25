<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\ServicePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ServiceController extends Controller
{
    // Listar servicios del cliente
    public function index()
    {
        $services = Auth::user()->services()
            ->with('payments')
            ->orderBy('expiry_date', 'desc')
            ->paginate(10);

        return view('customer.services.index', compact('services'));
    }

    public function catalog()
    {
        $plans = ServicePlan::where('is_active', true)->orderBy('type')->orderBy('price')->get();
        $paymentMethods = PaymentMethod::where('is_active', true)->orderBy('name')->get();

        return view('customer.services.catalog', compact('plans', 'paymentMethods'));
    }

    public function acquire(Request $request, ServicePlan $servicePlan)
    {
        if (!$servicePlan->is_active) {
            return back()->with('error', 'Este plan no se encuentra disponible.');
        }

        $validated = $request->validate([
            'domain' => ['nullable', 'string', 'max:255'],
            'service_name' => ['required', 'string', 'max:255'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'auto_renew' => ['nullable', 'boolean'],
        ]);

        $paymentMethod = PaymentMethod::where('id', $validated['payment_method_id'])
            ->where('is_active', true)
            ->firstOrFail();

        $startDate = Carbon::now();
        $expiryDate = $servicePlan->billing_cycle === 'yearly'
            ? $startDate->copy()->addYear()
            : $startDate->copy()->addMonth();

        $service = Auth::user()->services()->create([
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

        $payment = Auth::user()->payments()->create([
            'service_id' => $service->id,
            'amount' => $servicePlan->price,
            'currency' => 'PEN',
            'payment_method' => $paymentMethod->code,
            'status' => Payment::STATUS_PENDING,
            'payment_date' => $startDate,
            'due_date' => $startDate->copy()->addDays(3),
            'notes' => 'Pago generado automáticamente por compra de plan: ' . $servicePlan->name,
        ]);

        return redirect()->route('customer.payments.show', $payment->id)
            ->with('success', 'Servicio solicitado correctamente. Completa el pago para activar tu servicio.');
    }

    // Mostrar detalles de un servicio
    public function show($id)
    {
        $service = Auth::user()->services()
            ->with(['payments' => function($query) {
                $query->orderBy('payment_date', 'desc');
            }])
            ->findOrFail($id);

        return view('customer.services.show', compact('service'));
    }

    // Solicitar renovación
    public function requestRenewal($id)
    {
        $service = Auth::user()->services()->findOrFail($id);
        
        // Aquí iría la lógica para generar pago de renovación
        // Por ahora solo marcamos
        
        return back()->with('success', 'Solicitud de renovación enviada. Se generará una factura.');
    }

    // Solicitar soporte para servicio
    public function requestSupport($id)
    {
        $service = Auth::user()->services()->findOrFail($id);
        
        // Aquí iría la lógica para crear ticket de soporte
        // Por ahora redirigimos a contacto
        
        return redirect()->route('contacto.index')->with('service_id', $service->id);
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