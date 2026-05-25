@extends('bases.admin_base')

@section('title', 'Detalle de Pago')
@section('page-title', 'Detalle de Pago')
@section('breadcrumb', 'Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Pago #{{ $payment->id }}</h2>
    <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">Volver</a>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Datos del Cliente</h5>
                <p class="mb-1"><strong>Nombre:</strong> {{ $payment->user?->name }}</p>
                <p class="mb-1"><strong>Correo:</strong> {{ $payment->user?->email }}</p>
                <p class="mb-0"><strong>Empresa:</strong> {{ $payment->user?->company ?: 'N/A' }}</p>

                <hr>

                <h5 class="card-title">Datos del Servicio</h5>
                <p class="mb-1"><strong>Servicio:</strong> {{ $payment->service?->name ?? 'Sin servicio' }}</p>
                <p class="mb-1"><strong>Plan:</strong> {{ $payment->service?->plan ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Estado actual del servicio:</strong> {{ $payment->service?->status ?? 'N/A' }}</p>
                <p class="mb-0"><strong>Dominio:</strong> {{ $payment->service?->domain ?: 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Datos del Pago</h5>
                <p class="mb-1"><strong>Monto:</strong> S/. {{ number_format($payment->amount, 2) }}</p>
                <p class="mb-1"><strong>Método:</strong> {{ strtoupper($payment->payment_method) }}</p>
                <p class="mb-1"><strong>Estado:</strong> {{ $payment->status }}</p>
                <p class="mb-1"><strong>Referencia:</strong> {{ $payment->transaction_id ?: 'Sin referencia' }}</p>
                <p class="mb-1"><strong>Fecha:</strong> {{ $payment->payment_date?->format('d/m/Y') }}</p>
                <p class="mb-3"><strong>Vence:</strong> {{ $payment->due_date?->format('d/m/Y') }}</p>

                @if($payment->voucher_image)
                <div class="mb-3">
                    <h6>Comprobante subido por cliente</h6>
                    <img src="{{ Storage::url($payment->voucher_image) }}" alt="Comprobante" style="max-width: 100%; border-radius: 8px; border: 1px solid #dee2e6;">
                </div>
                @endif

                @if($payment->notes)
                <div class="alert alert-light border">
                    <strong>Notas:</strong><br>
                    {{ $payment->notes }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($payment->status === 'pending')
<div class="row mt-4 g-4">
    <div class="col-lg-6">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <h5 class="text-success">Confirmar Pago</h5>
                <p class="text-muted small">Al confirmar, el pago pasará a completado y el servicio quedará activo para el cliente.</p>
                <form method="POST" action="{{ route('admin.payments.approve', $payment) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nota interna (opcional)</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                    </div>
                    <button class="btn btn-success" type="submit">Confirmar pago y activar servicio</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-danger shadow-sm">
            <div class="card-body">
                <h5 class="text-danger">Rechazar Pago</h5>
                <p class="text-muted small">Usa esta opción si el comprobante no es válido o el pago no existe.</p>
                <form method="POST" action="{{ route('admin.payments.reject', $payment) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Motivo del rechazo</label>
                        <textarea name="notes" class="form-control" rows="3" required>{{ old('notes') }}</textarea>
                    </div>
                    <button class="btn btn-danger" type="submit">Rechazar pago</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection