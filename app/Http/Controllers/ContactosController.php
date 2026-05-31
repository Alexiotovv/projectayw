<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceived;
use App\Models\contactos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactosController extends Controller
{
    public function index()
    {
        return view('Contacto.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:190'],
            'message' => ['required', 'string', 'max:4000'],
        ]);

        $contacto = contactos::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending',
            'locale' => app()->getLocale(),
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        try {
            Mail::to('alexiotovv@gmail.com')->send(new ContactMessageReceived($contacto));
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()
            ->route('contacto.index')
            ->with('success', __('contact.thank_you_success'));
    }

    public function show(contactos $contactos)
    {
        //
    }

    public function edit(contactos $contactos)
    {
        //
    }

    public function update(Request $request, contactos $contactos)
    {
        //
    }

    public function destroy(contactos $contactos)
    {
        //
    }
}
