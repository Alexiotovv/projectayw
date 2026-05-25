<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin']);
    }

    public function index()
    {
        $methods = PaymentMethod::orderByDesc('created_at')->paginate(15);
        return view('admin.payment-methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment-methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'in:yape,plin,card,transfer,cash'],
            'type' => ['required', 'in:qr,card,transfer,cash'],
            'instructions' => ['nullable', 'string'],
            'qr_image' => ['nullable', 'image', 'max:3072'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_holder' => ['nullable', 'string', 'max:255'],
            'bank_account_number' => ['nullable', 'string', 'max:255'],
            'bank_account_cci' => ['nullable', 'string', 'max:255'],
            'gateway_url' => ['nullable', 'url', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $path = null;
        if ($request->hasFile('qr_image')) {
            $path = $request->file('qr_image')->store('payment-methods', 'public');
        }

        PaymentMethod::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'type' => $validated['type'],
            'instructions' => $validated['instructions'] ?? null,
            'qr_image_path' => $path,
            'bank_name' => $validated['bank_name'] ?? null,
            'bank_account_holder' => $validated['bank_account_holder'] ?? null,
            'bank_account_number' => $validated['bank_account_number'] ?? null,
            'bank_account_cci' => $validated['bank_account_cci'] ?? null,
            'gateway_url' => $validated['gateway_url'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Medio de pago creado correctamente.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'in:yape,plin,card,transfer,cash'],
            'type' => ['required', 'in:qr,card,transfer,cash'],
            'instructions' => ['nullable', 'string'],
            'qr_image' => ['nullable', 'image', 'max:3072'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_holder' => ['nullable', 'string', 'max:255'],
            'bank_account_number' => ['nullable', 'string', 'max:255'],
            'bank_account_cci' => ['nullable', 'string', 'max:255'],
            'gateway_url' => ['nullable', 'url', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $path = $paymentMethod->qr_image_path;
        if ($request->hasFile('qr_image')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('qr_image')->store('payment-methods', 'public');
        }

        $paymentMethod->update([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'type' => $validated['type'],
            'instructions' => $validated['instructions'] ?? null,
            'qr_image_path' => $path,
            'bank_name' => $validated['bank_name'] ?? null,
            'bank_account_holder' => $validated['bank_account_holder'] ?? null,
            'bank_account_number' => $validated['bank_account_number'] ?? null,
            'bank_account_cci' => $validated['bank_account_cci'] ?? null,
            'gateway_url' => $validated['gateway_url'] ?? null,
            'is_active' => $request->boolean('is_active', false),
        ]);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Medio de pago actualizado correctamente.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->qr_image_path) {
            Storage::disk('public')->delete($paymentMethod->qr_image_path);
        }

        $paymentMethod->delete();
        return redirect()->route('admin.payment-methods.index')->with('success', 'Medio de pago eliminado correctamente.');
    }
}
