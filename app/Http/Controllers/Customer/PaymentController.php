<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return view('customer.payment.index', compact('payments', 'summary'));
    }

    // Mostrar detalles de un pago
    public function show($id)
    {
        $payment = Auth::user()->payments()
            ->with(['service', 'user'])
            ->findOrFail($id);

        $paymentMethod = PaymentMethod::where('code', $payment->payment_method)->where('is_active', true)->first();

        return view('customer.payment.show', compact('payment', 'paymentMethod'));
    }

    public function submit(Request $request, $id)
    {
        $payment = Auth::user()->payments()->findOrFail($id);

        $validated = $request->validate([
            'transaction_id' => ['required', 'string', 'max:255'],
            'voucher_image' => ['nullable', 'image', 'max:4096'],
            'notes' => ['nullable', 'string'],
        ]);

        $path = $payment->voucher_image;
        if ($request->hasFile('voucher_image')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('voucher_image')->store('payment-vouchers', 'public');
        }

        $payment->update([
            'transaction_id' => $validated['transaction_id'],
            'voucher_image' => $path,
            'notes' => $validated['notes'] ?? $payment->notes,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Comprobante enviado correctamente. Validaremos tu pago en breve.');
    }

    // Generar nueva factura
    public function createInvoice(Request $request)
    {
        // Aquí iría la lógica para generar facturas
        // Por ahora es un placeholder
        
        return back()->with('info', 'Funcionalidad en desarrollo');
    }
}