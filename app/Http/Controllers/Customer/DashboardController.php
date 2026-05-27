<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Service;
use App\Models\Payment;

class DashboardController extends Controller
{
    // Dashboard principal
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'active_services' => $user->services()->active()->count(),
            'total_payments' => $user->payments()->where('status', 'completed')->count(),
            'pending_payments' => $user->payments()->where('status', 'pending')->count(),
            'email_services' => $user->services()->email()->active()->count(),
        ];

        $recent_services = $user->services()
            ->latest()
            ->limit(5)
            ->get();

        $recent_payments = $user->payments()
            ->latest()
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact('stats', 'recent_services', 'recent_payments'));
    }

    // Perfil del usuario
    public function profile()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }

    // Actualizar perfil
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $newEmail = $request->string('email')->lower()->value();
        $emailChanged = $newEmail !== $user->email;
        $pendingEmailChanged = $emailChanged && $newEmail !== $user->pending_email;

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
            }
        }

        DB::transaction(function () use ($request, $user, $newEmail, $emailChanged, $pendingEmailChanged): void {
            $user->name = $request->name;
            $user->company = $request->company;
            $user->phone = $request->phone;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if (! $emailChanged) {
                $user->pending_email = null;
            } elseif ($pendingEmailChanged) {
                $user->pending_email = $newEmail;
            }

            $user->save();
        });

        if ($pendingEmailChanged) {
            $user->sendPendingEmailVerificationNotification($newEmail);

            return back()->with('success', 'Perfil actualizado. Te enviamos un enlace de verificacion al nuevo correo para completar el cambio.');
        }

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    public function verifyPendingEmail(Request $request, string $id, string $hash): RedirectResponse
    {
        $user = Auth::user();

        abort_unless((string) $user->getKey() === (string) $id, 403);

        $pendingEmail = (string) $request->query('email', '');

        abort_unless(
            filled($user->pending_email)
            && hash_equals(sha1($user->pending_email), $hash)
            && hash_equals($user->pending_email, $pendingEmail),
            403
        );

        if (User::query()
            ->where('email', $pendingEmail)
            ->whereKeyNot($user->getKey())
            ->exists()) {
            return redirect()->route('customer.profile')
                ->withErrors(['email' => 'Ese correo ya esta siendo usado por otra cuenta.']);
        }

        DB::transaction(function () use ($user, $pendingEmail): void {
            $user->forceFill([
                'email' => $pendingEmail,
                'pending_email' => null,
                'email_verified_at' => now(),
            ])->save();
        });

        return redirect()->route('customer.profile')
            ->with('success', 'Tu nuevo correo fue verificado y actualizado correctamente.');
    }
}