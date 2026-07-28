@extends('bases.admin_base')

@section('title', 'Mis Pagos')
@section('page-title', 'Mis Pagos')
@section('breadcrumb', 'Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4">Mis Pagos</h2>
    <a href="{{ route('customer.services.catalog') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nuevo Servicio
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pagado
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            S/. {{ number_format($summary['total'], 2) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pendiente de Pago
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            S/. {{ number_format($summary['pending'], 2) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Facturas Pendientes
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $payments->where('status', 'pending')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Factura #</th>
                        <th>Fecha</th>
                        <th>Servicio</th>
                        <th>Monto</th>
                        <th>Medio</th>
                        <th>Comprobante</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>
                            <strong>FAC-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</strong><br>
                            @if($payment->service)
                                <small class="text-muted">{{ $payment->service->plan }}</small>
                            @endif
                        </td>
                        <td>
                            {{ $payment->payment_date?->format('d/m/Y') }}<br>
                            <small class="text-muted">Vence: {{ $payment->due_date?->format('d/m/Y') }}</small>
                        </td>
                        <td>
                            @if($payment->service)
                                {{ $payment->service->name }}
                            @else
                                <span class="text-muted">Servicio eliminado</span>
                            @endif
                        </td>
                        <td>
                            <strong>S/. {{ number_format($payment->amount, 2) }}</strong><br>
                            <small class="text-muted">{{ $payment->currency }}</small>
                        </td>
                        <td>
                            @switch($payment->payment_method)
                                @case('yape')
                                    <span class="badge bg-info">Yape</span>
                                    @break
                                @case('plin')
                                    <span class="badge bg-primary">Plin</span>
                                    @break
                                @case('card')
                                    <span class="badge bg-success">Tarjeta</span>
                                    @break
                                @case('transfer')
                                    <span class="badge bg-warning">Transferencia</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ $payment->payment_method }}</span>
                            @endswitch
                        </td>
                        <td>
                            <div class="d-flex gap-2 align-items-center">
                                <a href="{{ route('customer.payments.invoice', $payment->id) }}" class="btn btn-sm btn-outline-primary" title="Descargar comprobante PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <span class="small">{{ $payment->invoice_number }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-{{ $payment->status == 'completed' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ $payment->status }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('customer.payments.show', $payment->id) }}" 
                                   class="btn btn-info" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($payment->invoice_url)
                                <a href="{{ $payment->invoice_url }}" target="_blank" 
                                   class="btn btn-primary" title="Descargar factura">
                                    <i class="fas fa-download"></i>
                                </a>
                                @endif
                                @if($payment->status == 'pending')
                                <a href="{{ route('customer.payments.show', $payment->id) }}" class="btn btn-success" title="Completar pago">
                                    <i class="fas fa-credit-card"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay pagos registrados</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection