@extends('bases.admin_base')

@section('page-title', 'Gestión de Roles')
@section('breadcrumb', 'Roles')

@section('content')
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-user-tag me-2"></i>Roles del Sistema</h5>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nuevo Rol
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre del Rol</th>
                        <th>Permisos Asignados</th>
                        <th>Usuarios</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="fw-semibold text-capitalize">{{ $role->name }}</span>
                            @if($role->name === 'superadmin')
                                <span class="badge bg-danger ms-1">Sistema</span>
                            @elseif($role->name === 'admin')
                                <span class="badge bg-warning ms-1">Sistema</span>
                            @endif
                        </td>
                        <td>
                            @forelse($role->permissions->take(5) as $perm)
                                <span class="badge bg-secondary me-1 mb-1">{{ $perm->name }}</span>
                            @empty
                                <span class="text-muted">Sin permisos</span>
                            @endforelse
                            @if($role->permissions->count() > 5)
                                <span class="badge bg-light text-dark">+{{ $role->permissions->count() - 5 }} más</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $role->users()->count() }}</span>
                        </td>
                        <td class="text-end">
                            @if(!in_array($role->name, ['superadmin']))
                                <a href="{{ route('admin.roles.edit', $role) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            @if(!in_array($role->name, ['superadmin', 'admin']))
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Eliminar el rol {{ $role->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No hay roles registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
