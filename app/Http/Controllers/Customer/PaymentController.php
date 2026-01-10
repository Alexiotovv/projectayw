<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Listar pagos del cliente
    public function index()
    {
        $payments = Auth::user()->payments()
            ->with('service')
            ->orderBy('payment_date', 'desc')
            ->paginate(10);

        $summary = [
            'total' => Auth::user()->payments()->where('status', 'completed')->sum('amount'),
            'pending' => Auth::user()->payments()->where('status', 'pending')->sum('amount'),
        ];

        return view('customer.payments.index', compact('payments', 'summary'));
    }

    // Mostrar detalles de un pago
    public function show($id)
    {
        $payment = Auth::user()->payments()
            ->with(['service', 'user'])
            ->findOrFail($id);

        return view('customer.payments.show', compact('payment'));
    }

    // Generar nueva factura
    public function createInvoice(Request $request)
    {
        // Aquí iría la lógica para generar facturas
        // Por ahora es un placeholder
        
        return back()->with('info', 'Funcionalidad en desarrollo');
    }
}