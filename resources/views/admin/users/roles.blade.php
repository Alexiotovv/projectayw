@extends('bases.admin_base')

@section('page-title', 'Usuarios y Roles')
@section('breadcrumb', 'Usuarios / Roles')

@section('content')
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-users-cog me-2"></i>Usuarios — Gestión de Roles</h5>
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
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Roles</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->company ?? '—' }}</td>
                        <td>
                            @forelse($user->roles as $role)
                                <span class="badge
                                    @if($role->name === 'superadmin') bg-danger
                                    @elseif($role->name === 'admin') bg-warning
                                    @else bg-secondary @endif me-1">
                                    {{ $role->name }}
                                </span>
                            @empty
                                <span class="text-muted">Sin rol</span>
                            @endforelse
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.roles.edit', $user) }}"
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-user-tag me-1"></i> Asignar Roles
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
