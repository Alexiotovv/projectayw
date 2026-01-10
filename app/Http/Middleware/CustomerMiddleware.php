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
            return redirect()->route('customer.login');
        }

        if (!Auth::user()->isCustomer()) {
            Auth::logout();
            return redirect()->route('customer.login')->withErrors([
                'email' => 'Acceso no autorizado.',
            ]);
        }

        return $next($request);
    }
}