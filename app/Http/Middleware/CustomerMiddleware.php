<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // El superadmin puede entrar a rutas de cliente para revisión/soporte.
        if (Auth::user()->hasRole('superadmin')) {
            return $next($request);
        }

        if (!Auth::user()->isCustomer()) {
            return redirect()->back()->withErrors([
                'email' => 'Acceso no autorizado.',
            ]);
        }

        return $next($request);
    }
}