<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
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

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.customer-services.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}