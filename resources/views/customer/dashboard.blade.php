@extends('customer.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="h4">Bienvenido, {{ Auth::user()->name }}</h2>
        <p class="text-muted">Resumen de tus servicios y actividad</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 stat-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Servicios Activos
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active_services'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-server fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2 stat-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Correos Activos
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['email_services'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2 stat-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Pagos Completados
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_payments'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2 stat-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pagos Pendientes
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_payments'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Servicios Recientes -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Servicios Recientes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Estado</th>
                                <th>Vence</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_services as $service)
                            <tr>
                                <td>
                                    <strong>{{ $service->name }}</strong><br>
                                    <small class="text-muted">{{ $service->domain }}</small>
                                </td>
                                <td>{{ $service->plan }}</td>
                                <td>
                                    <span class="badge bg-{{ $service->status == 'active' ? 'success' : ($service->status == 'suspended' ? 'warning' : 'danger') }}">
                                        {{ $service->status }}
                                    </span>
                                </td>
                                <td>{{ $service->expiry_date->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No tienes servicios activos</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('customer.services') }}" class="btn btn-sm btn-primary">Ver todos los servicios</a>
            </div>
        </div>
    </div>

    <!-- Pagos Recientes -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pagos Recientes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Método</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_payments as $payment)
                            <tr>
                                <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                                <td>S/. {{ number_format($payment->amount, 2) }}</td>
                                <td>
                                    @switch($payment->payment_method)
                                        @case('yape')
                                            <span class="badge bg-info">Yape</span>
                                            @break
                                        @case('plin')
                                            <span class="badge bg-primary">Plin</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $payment->payment_method }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <span class="badge bg-{{ $payment->status == 'completed' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ $payment->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay pagos registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('customer.payments') }}" class="btn btn-sm btn-primary">Ver todos los pagos</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('customer.services') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-plus-circle me-2"></i>Nuevo Servicio
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('customer.payments') }}" class="btn btn-outline-success w-100">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Ver Facturas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('contacto.index') }}" class="btn btn-outline-info w-100">
                            <i class="fas fa-headset me-2"></i>Soporte
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('customer.profile') }}" class="btn btn-outline-warning w-100">
                            <i class="fas fa-cog me-2"></i>Configuración
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection