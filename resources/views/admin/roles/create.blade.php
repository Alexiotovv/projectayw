@extends('bases.admin_base')

@section('page-title', 'Nuevo Rol')
@section('breadcrumb', 'Roles / Nuevo')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-plus-circle me-2"></i>Crear Nuevo Rol</h5>
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

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre del Rol <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="ej: editor, moderador..." required>
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
                                           {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
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
                            <i class="fas fa-save me-1"></i> Guardar Rol
                        </button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.form-check-input { cursor: pointer; }
</style>
@endpush

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
