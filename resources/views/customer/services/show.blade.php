@extends('bases.admin_base')

@section('title', 'Detalle de Servicio')
@section('page-title', 'Detalle de Servicio')
@section('breadcrumb', 'Servicios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">{{ $service->name }}</h2>
    <a href="{{ route('customer.services') }}" class="btn btn-outline-secondary">Volver</a>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Información General</h6>
                <p class="mb-1"><strong>Tipo:</strong> {{ $service->type }}</p>
                <p class="mb-1"><strong>Plan:</strong> {{ $service->plan }}</p>
                <p class="mb-1"><strong>Dominio:</strong> {{ $service->domain ?: 'N/A' }}</p>
                <p class="mb-1"><strong>Estado:</strong> {{ $service->status }}</p>
                <p class="mb-1"><strong>Inicio:</strong> {{ $service->start_date?->format('d/m/Y') }}</p>
                <p class="mb-0"><strong>Vencimiento:</strong> {{ $service->expiry_date?->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Pagos Relacionados</h6>
                @forelse($service->payments as $payment)
                <div class="d-flex justify-content-between border-bottom py-2">
                    <div>
                        <div class="fw-semibold">S/. {{ number_format($payment->amount, 2) }}</div>
                        <small class="text-muted">{{ $payment->payment_method }} - {{ $payment->payment_date?->format('d/m/Y') }}</small>
                    </div>
                    <span class="badge bg-{{ $payment->status === 'completed' ? 'success' : 'warning' }}">{{ $payment->status }}</span>
                </div>
                @empty
                <p class="text-muted mb-0">Este servicio aún no tiene pagos asociados.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
