<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // Listar servicios del cliente
    public function index()
    {
        $services = Auth::user()->services()
            ->with('payments')
            ->orderBy('expiry_date', 'desc')
            ->paginate(10);

        return view('customer.services.index', compact('services'));
    }

    // Mostrar detalles de un servicio
    public function show($id)
    {
        $service = Auth::user()->services()
            ->with(['payments' => function($query) {
                $query->orderBy('payment_date', 'desc');
            }])
            ->findOrFail($id);

        return view('customer.services.show', compact('service'));
    }

    // Solicitar renovación
    public function requestRenewal($id)
    {
        $service = Auth::user()->services()->findOrFail($id);
        
        // Aquí iría la lógica para generar pago de renovación
        // Por ahora solo marcamos
        
        return back()->with('success', 'Solicitud de renovación enviada. Se generará una factura.');
    }

    // Solicitar soporte para servicio
    public function requestSupport($id)
    {
        $service = Auth::user()->services()->findOrFail($id);
        
        // Aquí iría la lógica para crear ticket de soporte
        // Por ahora redirigimos a contacto
        
        return redirect()->route('contacto.index')->with('service_id', $service->id);
    }
}