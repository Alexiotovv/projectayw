@extends('bases.admin_base')

@section('page-title', 'Editar Usuario')
@section('breadcrumb', 'Usuarios / Editar')

@section('content')
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-user-edit me-2"></i>Editar Usuario</h5>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nueva Contraseña (opcional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Empresa</label>
                <input type="text" name="company" class="form-control" value="{{ old('company', $user->company) }}">
            </div>

            <div class="col-12">
                <label class="form-label">Roles</label>
                <div class="row row-cols-2 row-cols-md-4 g-2">
                    @foreach($roles as $role)
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}"
                                   {{ in_array($role->id, old('roles', $userRoles)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
