@extends('bases.admin_base')

@section('title', 'Planes de Servicio')
@section('page-title', 'Planes de Servicio')
@section('breadcrumb', 'Catálogo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Planes Dinámicos</h2>
    <a href="{{ route('admin.service-plans.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nuevo Plan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Ciclo</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($plans as $plan)
                    <tr>
                        <td>
                            <strong>{{ $plan->name }}</strong>
                            <div class="text-muted small">{{ $plan->slug }}</div>
                        </td>
                        <td>
                            <span class="badge bg-{{ $plan->type === 'vps' ? 'primary' : 'info' }}">
                                {{ strtoupper($plan->type) }}
                            </span>
                        </td>
                        <td>S/. {{ number_format($plan->price, 2) }}</td>
                        <td>{{ $plan->billing_cycle === 'yearly' ? 'Anual' : 'Mensual' }}</td>
                        <td>
                            <span class="badge bg-{{ $plan->is_active ? 'success' : 'secondary' }}">
                                {{ $plan->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.service-plans.edit', $plan) }}" class="btn btn-sm btn-outline-primary">
                                Editar
                            </a>
                            <form action="{{ route('admin.service-plans.destroy', $plan) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este plan?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No hay planes creados todavía.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $plans->links() }}
        </div>
    </div>
</div>
@endsection
