<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin|admin']);
    }

    public function index(Request $request)
    {
        $status = $request->query('status');

        $payments = Payment::with(['user', 'service'])
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.payments.index', compact('payments', 'status'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['user', 'service']);

        return view('admin.payments.show', compact('payment'));
    }

    public function approve(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'notes' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($payment, $validated) {
            $payment->update([
                'status' => Payment::STATUS_COMPLETED,
                'notes' => $validated['notes'] ?? $payment->notes,
            ]);

            if ($payment->service && $payment->service->status !== 'active') {
                $payment->service->update([
                    'status' => 'active',
                ]);
            }
        });

        return redirect()->route('admin.payments.show', $payment)
            ->with('success', 'Pago confirmado y servicio activado correctamente.');
    }

    public function reject(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'notes' => ['required', 'string'],
        ]);

        DB::transaction(function () use ($payment, $validated) {
            $payment->update([
                'status' => Payment::STATUS_FAILED,
                'notes' => $validated['notes'],
            ]);

            if ($payment->service && $payment->service->status === 'active') {
                $payment->service->update([
                    'status' => 'suspended',
                ]);
            }
        });

        return redirect()->route('admin.payments.show', $payment)
            ->with('success', 'Pago rechazado correctamente.');
    }
}