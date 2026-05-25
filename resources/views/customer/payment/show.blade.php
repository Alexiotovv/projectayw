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
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Resumen</h6>
                <p class="mb-1"><strong>Servicio:</strong> {{ $payment->service?->name ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Monto:</strong> S/. {{ number_format($payment->amount, 2) }}</p>
                <p class="mb-1"><strong>Método:</strong> {{ strtoupper($payment->payment_method) }}</p>
                <p class="mb-1"><strong>Estado:</strong> {{ $payment->status }}</p>
                <p class="mb-0"><strong>Vence:</strong> {{ $payment->due_date?->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Instrucciones de Pago</h6>
                @if($paymentMethod)
                    <p class="mb-2">{{ $paymentMethod->instructions ?: 'Usa este método y registra tu comprobante.' }}</p>

                    @if($paymentMethod->type === 'qr' && $paymentMethod->qr_image_path)
                    <div class="mb-3 text-center">
                        <img src="{{ Storage::url($paymentMethod->qr_image_path) }}" alt="Código QR" style="max-width: 220px; width: 100%; border-radius: 8px;">
                    </div>
                    @endif
                @else
                    <p class="text-muted">No hay instrucciones configuradas para este método.</p>
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
