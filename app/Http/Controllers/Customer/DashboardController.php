<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->company = $request->company;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente');
    }
}