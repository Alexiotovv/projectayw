@extends('bases.admin_base')

@section('title', 'Detalle de Servicio')
@section('page-title', 'Detalle de Servicio')
@section('breadcrumb', 'Servicios Contratados')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-0">{{ $service->name }}</h2>
        <div class="small text-muted">Cliente: {{ $service->user?->name }} - {{ $service->user?->email }}</div>
    </div>
    <a href="{{ route('admin.customer-services.index') }}" class="btn btn-outline-secondary">Volver</a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Información del Servicio</h5>
                <p class="mb-1"><strong>Plan:</strong> {{ $service->servicePlan?->name ?? $service->plan }}</p>
                <p class="mb-1"><strong>Tipo:</strong> {{ ucfirst($service->type) }}</p>
                <p class="mb-1"><strong>Estado:</strong> {{ ucfirst($service->status) }}</p>
                <p class="mb-1"><strong>Inicio:</strong> {{ $service->start_date?->format('d/m/Y') }}</p>
                <p class="mb-1"><strong>Vencimiento:</strong> {{ $service->expiry_date?->format('d/m/Y') }}</p>
                <p class="mb-1"><strong>Auto-renovación:</strong> {{ $service->auto_renew ? 'Sí' : 'No' }}</p>
                <p class="mb-0"><strong>Siguiente ciclo:</strong> {{ optional($service->nextBillingDate())->format('d/m/Y') ?: 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="card-title mb-0">Pagos Pendientes</h5>
                                <p class="text-muted small mb-0">Pagos pendientes para este servicio.</p>
                            </div>
                            <span class="badge bg-warning">{{ $pendingPayments->count() }} pendientes</span>
                        </div>

                        @forelse($pendingPayments as $payment)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">S/. {{ number_format($payment->amount, 2) }}</div>
                                    <small class="text-muted">{{ $payment->payment_method }} • Fecha: {{ $payment->payment_date?->format('d/m/Y') }} • Vence: {{ $payment->due_date?->format('d/m/Y') }}</small>
                                </div>
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">Ver pago</a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No hay pagos pendientes.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="card-title mb-0">Pagos Realizados</h5>
                                <p class="text-muted small mb-0">Historial de pagos completados.</p>
                            </div>
                            <span class="badge bg-success">{{ $completedPayments->count() }} completados</span>
                        </div>

                        @forelse($completedPayments as $payment)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">S/. {{ number_format($payment->amount, 2) }}</div>
                                    <small class="text-muted">{{ $payment->payment_method }} • Fecha: {{ $payment->payment_date?->format('d/m/Y') }}</small>
                                </div>
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-secondary">Ver pago</a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No hay pagos realizados.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Generar pago manual</h5>

                        <form method="POST" action="{{ route('admin.customer-services.payments.store', $service) }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Monto</label>
                                    <input type="number" name="amount" step="0.01" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $service->servicePlan?->price ?? 0) }}" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Método de pago</label>
                                    <select name="payment_method_id" class="form-select @error('payment_method_id') is-invalid @enderror" required>
                                        <option value="">Selecciona</option>
                                        @foreach($paymentMethods as $method)
                                            <option value="{{ $method->id }}" @selected(old('payment_method_id') == $method->id)>{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_method_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Fecha de pago</label>
                                    <input type="text" class="form-control" value="{{ now()->format('d/m/Y') }}" disabled>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Notas</label>
                                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', 'Pago manual generado por administrador') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-success">Generar pago manual</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
