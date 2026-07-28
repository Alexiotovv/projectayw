<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Barryvdh\DomPDF\Facade\Pdf;
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

        $paymentMethod = PaymentMethod::where('code', $payment->payment_method)->first();
        $paymentMethods = PaymentMethod::where('is_active', true)->orderBy('name')->get();

        return view('customer.payment.show', compact('payment', 'paymentMethod', 'paymentMethods'));
    }

    public function invoice($id)
    {
        $payment = Auth::user()->payments()
            ->with(['service', 'user'])
            ->findOrFail($id);

        $paymentMethod = PaymentMethod::where('code', $payment->payment_method)->first();

        $pdf = Pdf::loadView('customer.payment.invoice', compact('payment', 'paymentMethod'));

        return $pdf->stream("comprobante-{$payment->invoice_number}.pdf");
    }

    public function updateMethod(Request $request, $id)
    {
        $payment = Auth::user()->payments()->findOrFail($id);

        if ($payment->status !== 'pending') {
            return back()->with('error', 'Solo puedes cambiar el método de pago cuando la factura está pendiente.');
        }

        $validated = $request->validate([
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
        ]);

        $paymentMethod = PaymentMethod::where('id', $validated['payment_method_id'])
            ->where('is_active', true)
            ->firstOrFail();

        $payment->update([
            'payment_method' => $paymentMethod->code,
            'transaction_id' => null,
            'voucher_image' => null,
            'notes' => null,
        ]);

        return back()->with('success', 'Método de pago actualizado. Ya puedes seguir las nuevas instrucciones.');
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