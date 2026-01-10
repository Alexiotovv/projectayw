@extends('customer.layouts.app')

@section('title', 'Mis Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4">Mis Pagos</h2>
    <div class="btn-group">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
            <i class="fas fa-plus me-2"></i>Realizar Pago
        </button>
        <a href="#" class="btn btn-outline-secondary">
            <i class="fas fa-download me-2"></i>Exportar
        </a>
    </div>
</div>

<!-- Resumen de pagos -->
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
                            Próximo Vencimiento
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            15 Días
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

<!-- Lista de pagos -->
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
                        <th>Método</th>
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
                            {{ $payment->payment_date->format('d/m/Y') }}<br>
                            <small class="text-muted">Vence: {{ $payment->due_date->format('d/m/Y') }}</small>
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
                                <button class="btn btn-success" title="Pagar ahora" 
                                        onclick="payInvoice({{ $payment->id }})">
                                    <i class="fas fa-credit-card"></i>
                                </button>
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
        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $payments->links() }}
        </div>
    </div>
</div>

<!-- Modal de pago -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Realizar Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    @csrf
                    <div class="mb-3">
                        <label for="paymentService" class="form-label">Servicio a Pagar *</label>
                        <select class="form-control" id="paymentService" name="service_id" required>
                            <option value="">Seleccionar servicio...</option>
                            @foreach(Auth::user()->services()->active()->get() as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }} - {{ $service->plan }} (Vence: {{ $service->expiry_date->format('d/m/Y') }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Monto (S/.) *</label>
                        <input type="number" step="0.01" class="form-control" 
                               id="paymentAmount" name="amount" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Método de Pago *</label>
                        <select class="form-control" id="paymentMethod" name="payment_method" required>
                            <option value="">Seleccionar método...</option>
                            <option value="yape">Yape</option>
                            <option value="plin">Plin</option>
                            <option value="transfer">Transferencia Bancaria</option>
                            <option value="cash">Depósito en Efectivo</option>
                        </select>
                    </div>
                    
                    <div id="yapeInfo" style="display: none;">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-mobile-alt me-2"></i>Pago por Yape</h6>
                            <p class="mb-2">Número: <strong>980-534-198</strong></p>
                            <p class="mb-0">Nombre: <strong>AYW Solutions</strong></p>
                            <p class="mt-2 mb-0 small">
                                <i class="fas fa-info-circle me-1"></i>
                                Envía el comprobante a WhatsApp: 980-534-198
                            </p>
                        </div>
                    </div>
                    
                    <div id="plinInfo" style="display: none;">
                        <div class="alert alert-primary">
                            <h6><i class="fas fa-mobile-alt me-2"></i>Pago por Plin</h6>
                            <p class="mb-2">Número: <strong>980-534-198</strong></p>
                            <p class="mb-0">Nombre: <strong>AYW Solutions</strong></p>
                            <p class="mt-2 mb-0 small">
                                <i class="fas fa-info-circle me-1"></i>
                                Envía el comprobante a WhatsApp: 980-534-198
                            </p>
                        </div>
                    </div>
                    
                    <div id="transferInfo" style="display: none;">
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-university me-2"></i>Transferencia Bancaria</h6>
                            <p class="mb-1"><strong>Banco: </strong>BCP</p>
                            <p class="mb-1"><strong>Cuenta: </strong>191-23456789-0-45</p>
                            <p class="mb-1"><strong>Tipo: </strong>Ahorros Soles</p>
                            <p class="mb-1"><strong>Titular: </strong>AYW Solutions SAC</p>
                            <p class="mb-0"><strong>RUC: </strong>20612345678</p>
                            <p class="mt-2 mb-0 small">
                                <i class="fas fa-info-circle me-1"></i>
                                Envía el voucher a: pagos@aywsolution.com
                            </p>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="transactionId" class="form-label">N° de Operación / Voucher *</label>
                        <input type="text" class="form-control" 
                               id="transactionId" name="transaction_id" required>
                    </div>
                    
                    <div class="alert alert-light">
                        <h6><i class="fas fa-clock me-2"></i>Procesamiento</h6>
                        <p class="mb-0 small">
                            Los pagos se verifican manualmente en un plazo de 24 horas.
                            Recibirás una notificación por email cuando tu pago sea confirmado.
                        </p>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Enviar Comprobante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Mostrar información según método de pago
    document.getElementById('paymentMethod').addEventListener('change', function() {
        // Ocultar todos primero
        document.getElementById('yapeInfo').style.display = 'none';
        document.getElementById('plinInfo').style.display = 'none';
        document.getElementById('transferInfo').style.display = 'none';
        
        // Mostrar el seleccionado
        if (this.value === 'yape') {
            document.getElementById('yapeInfo').style.display = 'block';
        } else if (this.value === 'plin') {
            document.getElementById('plinInfo').style.display = 'block';
        } else if (this.value === 'transfer') {
            document.getElementById('transferInfo').style.display = 'block';
        }
    });
    
    // Auto-calcular monto basado en servicio
    document.getElementById('paymentService').addEventListener('change', function() {
        // Aquí podrías hacer una petición AJAX para obtener el monto del servicio
        // Por ahora usamos un valor fijo
        if (this.value) {
            document.getElementById('paymentAmount').value = '49.90';
        }
    });
    
    // Enviar formulario de pago
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Aquí iría la lógica para enviar al backend
        alert('Comprobante enviado. Nos pondremos en contacto contigo para confirmar el pago.');
        
        // Cerrar modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
        modal.hide();
    });
    
    function payInvoice(paymentId) {
        // Aquí iría la lógica para redirigir a pago
        alert('Función de pago en línea en desarrollo. Por favor, usa el botón "Realizar Pago".');
    }
</script>
@endsection