@extends('bases.admin_base')

@section('page-title', 'Asignar Roles')
@section('breadcrumb', 'Usuarios / Asignar Roles')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card mb-3">
            <div class="card-header">
                <h5><i class="fas fa-user-tag me-2"></i>Roles y Permisos: <strong>{{ $user->name }}</strong></h5>
                <a href="{{ route('admin.users.roles') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3 p-3 bg-light rounded">
                    <div class="row">
                        <div class="col-md-4"><strong>Email:</strong> {{ $user->email }}</div>
                        <div class="col-md-4"><strong>Empresa:</strong> {{ $user->company ?? '—' }}</div>
                        <div class="col-md-4"><strong>Registro:</strong> {{ $user->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.users.roles.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Roles --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-user-shield me-1 text-primary"></i> Roles
                        </label>
                        <div class="row row-cols-2 row-cols-md-4 g-2">
                            @foreach($roles as $role)
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="roles[]" value="{{ $role->id }}"
                                           id="role_{{ $role->id }}"
                                           {{ in_array($role->id, old('roles', $userRoles)) ? 'checked' : '' }}
                                           @if($role->name === 'superadmin' && !auth()->user()->hasRole('superadmin')) disabled @endif>
                                    <label class="form-check-label text-capitalize" for="role_{{ $role->id }}">
                                        {{ $role->name }}
                                        @if($role->name === 'superadmin')
                                            <span class="badge bg-danger">Sistema</span>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    {{-- Permisos directos --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-key me-1 text-warning"></i> Permisos Directos
                                <small class="text-muted fw-normal">(adicionales al rol)</small>
                            </span>
                            <div>
                                <a href="#" class="small me-2" id="select-all">Seleccionar todos</a>
                                <a href="#" class="small" id="deselect-all">Limpiar</a>
                            </div>
                        </label>
                        <div class="row row-cols-1 row-cols-md-3 g-2">
                            @foreach($permissions as $permission)
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input perm-check" type="checkbox"
                                           name="permissions[]" value="{{ $permission->id }}"
                                           id="perm_{{ $permission->id }}"
                                           {{ in_array($permission->id, old('permissions', $userPermissions)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar Cambios
                        </button>
                        <a href="{{ route('admin.users.roles') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('select-all').addEventListener('click', function(e){
    e.preventDefault();
    document.querySelectorAll('.perm-check').forEach(c => c.checked = true);
});
document.getElementById('deselect-all').addEventListener('click', function(e){
    e.preventDefault();
    document.querySelectorAll('.perm-check').forEach(c => c.checked = false);
});
</script>
@endpush
