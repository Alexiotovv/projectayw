@extends('bases.admin_base')

@section('title', 'Medios de Pago')
@section('page-title', 'Medios de Pago')
@section('breadcrumb', 'Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Métodos Configurados</h2>
    <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nuevo Método
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>QR</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($methods as $method)
                    <tr>
                        <td>{{ $method->name }}</td>
                        <td><span class="badge bg-light text-dark">{{ $method->code }}</span></td>
                        <td>{{ strtoupper($method->type) }}</td>
                        <td>
                            @if($method->qr_image_url)
                            <img src="{{ $method->qr_image_url }}" alt="QR" style="width: 56px; height: 56px; object-fit: cover; border-radius: 6px;">
                            @else
                            <span class="text-muted">No</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $method->is_active ? 'success' : 'secondary' }}">
                                {{ $method->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.payment-methods.edit', $method) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este método de pago?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No hay métodos de pago configurados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $methods->links() }}
        </div>
    </div>
</div>
@endsection
