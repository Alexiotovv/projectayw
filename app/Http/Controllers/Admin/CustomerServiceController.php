<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin|admin']);
    }

    public function index(Request $request)
    {
        $status = $request->query('status');

        $services = Service::with(['user', 'servicePlan'])
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.customer-services.index', compact('services', 'status'));
    }

    public function show(Service $service)
    {
        $service->load(['user', 'servicePlan', 'payments' => function ($query) {
            $query->orderByDesc('payment_date');
        }]);

        $paymentMethods = PaymentMethod::where('is_active', true)
            ->orderBy('name')
            ->get();

        $pendingPayments = $service->payments->where('status', Payment::STATUS_PENDING);
        $completedPayments = $service->payments->where('status', Payment::STATUS_COMPLETED);

        return view('admin.customer-services.show', compact('service', 'paymentMethods', 'pendingPayments', 'completedPayments'));
    }

    public function storePayment(Request $request, Service $service)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'payment_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $paymentMethod = PaymentMethod::where('id', $validated['payment_method_id'])
            ->where('is_active', true)
            ->firstOrFail();

        $service->payments()->create([
            'user_id' => $service->user_id,
            'amount' => $validated['amount'],
            'currency' => 'PEN',
            'payment_method' => $paymentMethod->code,
            'status' => Payment::STATUS_PENDING,
            'payment_date' => Carbon::parse($validated['payment_date']),
            'due_date' => Carbon::parse($validated['payment_date'])->addDays(3),
            'notes' => $validated['notes'] ?? 'Pago manual generado por administrador',
        ]);

        return redirect()->route('admin.customer-services.show', $service)
            ->with('success', 'Pago pendiente generado correctamente para el servicio.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.customer-services.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}