@extends('bases.admin_base')

@section('page-title', 'Editar Rol')
@section('breadcrumb', 'Roles / Editar')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-edit me-2"></i>Editar Rol: <strong>{{ $role->name }}</strong></h5>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre del Rol <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $role->name) }}" required {{ $role->name === 'superadmin' ? 'readonly' : '' }}>
                        @if($role->name === 'superadmin')
                            <small class="text-muted">El nombre del rol superadmin no se puede cambiar, pero sus permisos si.</small>
                        @endif
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label d-flex align-items-center justify-content-between">
                            <span>Permisos</span>
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
                                           {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
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
                            <i class="fas fa-save me-1"></i> Actualizar Rol
                        </button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
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
