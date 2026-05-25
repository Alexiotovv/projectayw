@extends('bases.admin_base')

@section('title', 'Editar Plan')
@section('page-title', 'Editar Plan de Servicio')
@section('breadcrumb', 'Catálogo')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.service-plans.update', $servicePlan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $servicePlan->name) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select name="type" id="type_select" class="form-select" required>
                        <option value="">Selecciona un tipo</option>
                        @foreach($types as $type)
                        <option value="{{ $type }}" @selected(old('type', $servicePlan->type) === $type)>{{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $type)) }}</option>
                        @endforeach
                        <option value="__new__" @selected(old('type') === '__new__')>+ Agregar nuevo tipo</option>
                    </select>
                    <input type="text" id="type_custom" name="type_custom" class="form-control mt-2" placeholder="Ej: web-hosting" value="{{ old('type_custom') }}" style="display: {{ old('type') === '__new__' ? 'block' : 'none' }};">
                    <small class="text-muted">Puedes elegir uno existente o crear uno nuevo.</small>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="price" class="form-control" min="0" step="0.01" value="{{ old('price', $servicePlan->price) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ciclo</label>
                    <select name="billing_cycle" class="form-select" required>
                        <option value="monthly" @selected(old('billing_cycle', $servicePlan->billing_cycle) === 'monthly')>Mensual</option>
                        <option value="yearly" @selected(old('billing_cycle', $servicePlan->billing_cycle) === 'yearly')>Anual</option>
                    </select>
                </div>
                <div class="col-md-9">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description', $servicePlan->description) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Características (una por línea)</label>
                    <textarea name="features" rows="6" class="form-control">{{ old('features', collect($servicePlan->features)->implode("\n")) }}</textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $servicePlan->is_active))>
                        <label class="form-check-label" for="is_active">Plan activo</label>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('admin.service-plans.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type_select');
    const customInput = document.getElementById('type_custom');

    typeSelect.addEventListener('change', function () {
        customInput.style.display = this.value === '__new__' ? 'block' : 'none';
        if (this.value !== '__new__') {
            customInput.value = '';
        }
    });
});
</script>
@endpush
