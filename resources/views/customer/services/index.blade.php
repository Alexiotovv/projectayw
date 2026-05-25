@extends('bases.admin_base')

@section('title', 'Mis Servicios')
@section('page-title', 'Mis Servicios')
@section('breadcrumb', 'Servicios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4">Mis Servicios</h2>
    <a href="{{ route('customer.services.catalog') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Contratar Servicio
    </a>
</div>

@if($services->isEmpty())
<div class="card shadow">
    <div class="card-body text-center py-5">
        <i class="fas fa-server fa-4x text-muted mb-3"></i>
        <h5>No tienes servicios contratados</h5>
        <p class="text-muted">Comienza contratando tu primer servicio VPS o de correo corporativo.</p>
        <a href="{{ route('customer.services.catalog') }}" class="btn btn-primary">
            Contratar Primer Servicio
        </a>
    </div>
</div>
@else
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Tipo</th>
                        <th>Plan</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th>Vencimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>
                            <strong>{{ $service->name }}</strong><br>
                            <small class="text-muted">{{ $service->domain }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $service->type === 'hosting' ? 'primary' : 'info' }}">
                                {{ $service->type === 'hosting' ? 'VPS' : 'Correo' }}
                            </span>
                        </td>
                        <td>{{ $service->plan }}</td>
                        <td>
                            @if($service->type == 'email')
                                <i class="fas fa-envelope me-1"></i> {{ $service->email_accounts }} cuentas
                            @else
                                <i class="fas fa-microchip me-1"></i> VPS gestionado
                            @endif
                            <br>
                            <small class="text-muted"><i class="fas fa-database me-1"></i>{{ $service->storage_gb }} GB</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $service->status == 'active' ? 'success' : ($service->status == 'suspended' ? 'warning' : 'secondary') }}">
                                {{ $service->status }}
                            </span>
                        </td>
                        <td>
                            {{ $service->expiry_date->format('d/m/Y') }}<br>
                            <small class="text-muted">{{ $service->expiry_date->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('customer.services.show', $service->id) }}" 
                                   class="btn btn-info" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($service->status == 'active')
                                <a href="{{ route('customer.services.requestSupport', $service->id) }}" 
                                   class="btn btn-warning" title="Soporte">
                                    <i class="fas fa-headset"></i>
                                </a>
                                <a href="{{ route('customer.services.requestRenewal', $service->id) }}" 
                                   class="btn btn-success" title="Renovar">
                                    <i class="fas fa-redo"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endif
@endsection