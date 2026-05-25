@extends('bases.admin_base')

@section('title', 'Revisar Pagos')
@section('page-title', 'Revisar Pagos')
@section('breadcrumb', 'Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Pagos de Clientes</h2>
    <form method="GET" action="{{ route('admin.payments.index') }}" class="d-flex gap-2">
        <select name="status" class="form-select">
            <option value="">Todos</option>
            <option value="pending" @selected($status === 'pending')>Pendientes</option>
            <option value="completed" @selected($status === 'completed')>Completados</option>
            <option value="failed" @selected($status === 'failed')>Rechazados</option>
        </select>
        <button class="btn btn-primary" type="submit">Filtrar</button>
    </form>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Monto</th>
                        <th>Método</th>
                        <th>Comprobante</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>
                            <strong>{{ $payment->user?->name }}</strong>
                            <div class="small text-muted">{{ $payment->user?->email }}</div>
                        </td>
                        <td>
                            {{ $payment->service?->name ?? 'Sin servicio' }}
                            <div class="small text-muted">{{ $payment->service?->plan }}</div>
                        </td>
                        <td>S/. {{ number_format($payment->amount, 2) }}</td>
                        <td>{{ strtoupper($payment->payment_method) }}</td>
                        <td>
                            @if($payment->transaction_id)
                                <span class="small">{{ $payment->transaction_id }}</span>
                            @else
                                <span class="text-muted small">Sin referencia</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $payment->status === 'completed' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning') }}">
                                {{ $payment->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">Revisar</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No hay pagos para mostrar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection