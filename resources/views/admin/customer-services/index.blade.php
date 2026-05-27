@extends('bases.admin_base')

@section('title', 'Servicios Contratados')
@section('page-title', 'Servicios Contratados')
@section('breadcrumb', 'Servicios Contratados')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Servicios de Clientes</h2>
    <form method="GET" action="{{ route('admin.customer-services.index') }}" class="d-flex gap-2">
        <select name="status" class="form-select">
            <option value="">Todos</option>
            <option value="pending" @selected($status === 'pending')>Pendientes</option>
            <option value="active" @selected($status === 'active')>Activos</option>
            <option value="suspended" @selected($status === 'suspended')>Suspendidos</option>
            <option value="cancelled" @selected($status === 'cancelled')>Cancelados</option>
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
                        <th>Tipo</th>
                        <th>Plan</th>
                        <th>Estado</th>
                        <th>Vencimiento</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>
                            <strong>{{ $service->user?->name }}</strong>
                            <div class="small text-muted">{{ $service->user?->email }}</div>
                        </td>
                        <td>
                            {{ $service->name }}
                            <div class="small text-muted">{{ $service->domain ?: 'Sin dominio' }}</div>
                        </td>
                        <td>{{ strtoupper($service->type) }}</td>
                        <td>{{ $service->servicePlan?->name ?? $service->plan }}</td>
                        <td>
                            <span class="badge bg-{{ $service->status === 'active' ? 'success' : ($service->status === 'suspended' ? 'warning' : ($service->status === 'cancelled' ? 'secondary' : 'info')) }}">
                                {{ $service->status }}
                            </span>
                        </td>
                        <td>{{ optional($service->expiry_date)->format('d/m/Y') ?: 'N/A' }}</td>
                        <td class="text-end">
                            <form method="POST" action="{{ route('admin.customer-services.destroy', $service) }}" class="d-inline" onsubmit="return confirm('¿Eliminar este servicio contratado?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No hay servicios para mostrar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection