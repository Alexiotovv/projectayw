@extends('bases.admin_base')

@section('title', 'Detalle de Pago')
@section('page-title', 'Detalle de Pago')
@section('breadcrumb', 'Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Factura FAC-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</h2>
    <a href="{{ route('customer.payments') }}" class="btn btn-outline-secondary">Volver</a>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Factura</h6>
                <p class="mb-1"><strong>Número:</strong> {{ $payment->invoice_number }}</p>
                <p class="mb-1"><strong>Servicio:</strong> {{ $payment->service?->name ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Plan:</strong> {{ $payment->service?->plan ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Monto:</strong> S/. {{ number_format($payment->amount, 2) }}</p>
                <p class="mb-1"><strong>Método:</strong> {{ strtoupper($payment->payment_method) }}</p>
                <p class="mb-1"><strong>Fecha pago:</strong> {{ $payment->payment_date?->format('d/m/Y') }}</p>
                <p class="mb-0"><strong>Vencimiento:</strong> {{ $payment->due_date?->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Comprobante</h6>
                <p class="mb-1"><strong>Estado:</strong>
                    <span class="badge bg-{{ $payment->status == 'completed' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Descripción:</strong> Pago recurrente del servicio {{ $payment->service?->plan ?? 'N/A' }}.</p>
                <p class="mb-1"><strong>Referencia:</strong> {{ $payment->transaction_id ?: 'No registrada' }}</p>
                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('customer.payments.invoice', $payment->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-file-pdf me-1"></i> Descargar comprobante PDF
                    </a>
                    @if($payment->voucher_image)
                        <a href="{{ Storage::url($payment->voucher_image) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-image me-1"></i> Ver imagen del comprobante
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Estado del servicio</h6>
                <p class="mb-1"><strong>Servicio:</strong> {{ $payment->service?->name ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Plan:</strong> {{ $payment->service?->plan ?? 'N/A' }}</p>
                <p class="mb-0"><strong>Dominio:</strong> {{ $payment->service?->domain ?: 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Instrucciones de Pago</h6>
                @if($paymentMethod)
                    <p class="mb-2">{{ $paymentMethod->instructions ?: 'Usa este método y registra tu comprobante.' }}</p>

                    @if($paymentMethod->type === 'qr' && $paymentMethod->qr_image_url)
                    <div class="mb-3 text-center">
                        <img src="{{ $paymentMethod->qr_image_url }}" alt="Código QR" style="max-width: 220px; width: 100%; border-radius: 8px;">
                    </div>
                    @endif

                    @if($paymentMethod->type === 'transfer')
                    <div class="alert alert-warning mb-3">
                        <h6 class="mb-2">Datos bancarios para transferencia</h6>
                        <p class="mb-1"><strong>Banco:</strong> {{ $paymentMethod->bank_name ?: 'N/A' }}</p>
                        <p class="mb-1"><strong>Titular:</strong> {{ $paymentMethod->bank_account_holder ?: 'N/A' }}</p>
                        <p class="mb-1"><strong>N° Cuenta:</strong> {{ $paymentMethod->bank_account_number ?: 'N/A' }}</p>
                        <p class="mb-0"><strong>CCI:</strong> {{ $paymentMethod->bank_account_cci ?: 'N/A' }}</p>
                    </div>
                    @endif

                    @if($paymentMethod->type === 'card')
                    <div class="mb-3">
                        @if($paymentMethod->qr_image_url)
                        <div class="text-center mb-2">
                            <img src="{{ $paymentMethod->qr_image_url }}" alt="Logo pasarela de pago" style="max-height: 80px; max-width: 200px; object-fit: contain;">
                        </div>
                        @endif
                        @if($paymentMethod->gateway_url)
                        <a href="{{ $paymentMethod->gateway_url }}" target="_blank" class="btn btn-success w-100">
                            Pagar con tarjeta
                        </a>
                        @else
                        <div class="alert alert-info mb-0">No hay enlace de pasarela configurado para tarjeta.</div>
                        @endif
                    </div>
                    @endif
                @else
                    <p class="text-muted">No hay instrucciones configuradas para este método.</p>
                @endif

                @if($payment->status === 'pending')
                <hr>
                <h6 class="mb-2">Cambiar método de pago</h6>
                <form action="{{ route('customer.payments.updateMethod', $payment->id) }}" method="POST" class="mb-3">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Método disponible</label>
                        <select name="payment_method_id" class="form-select" required>
                            <option value="">Selecciona...</option>
                            @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}" @selected($method->code === $payment->payment_method)>
                                {{ $method->name }} ({{ strtoupper($method->type) }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-outline-primary w-100" type="submit">Actualizar método</button>
                </form>
                @endif

                <form action="{{ route('customer.payments.submit', $payment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">N° de operación / referencia</label>
                        <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id', $payment->transaction_id) }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Imagen de comprobante (opcional)</label>
                        <input type="file" name="voucher_image" class="form-control" accept="image/*">
                        @if($payment->voucher_image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($payment->voucher_image) }}" alt="Comprobante" style="max-width: 220px; width: 100%; border-radius: 8px;">
                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notas</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Enviar comprobante</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
