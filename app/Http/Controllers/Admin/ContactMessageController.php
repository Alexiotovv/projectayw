<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\contactos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin|admin']);
    }

    public function index(Request $request)
    {
        $status = $request->query('status');

        $messages = contactos::query()
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.contact-messages.index', compact('messages', 'status'));
    }

    public function update(Request $request, contactos $contacto): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,contacted'],
            'admin_notes' => ['nullable', 'string', 'max:3000'],
        ]);

        $contacto->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? null,
            'contacted_at' => $validated['status'] === 'contacted' ? now() : null,
        ]);

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Consulta actualizada correctamente.');
    }

    public function destroy(contactos $contacto): RedirectResponse
    {
        $contacto->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Consulta eliminada correctamente.');
    }
}
