{{-- resources/views/certificados/edit.blade.php --}}
@extends('bases.admin_base')

@section('admin_contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('certificados.index') }}">Certificados</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Certificado</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Editar Certificado
                    </h4>
                    <small class="text-dark">
                        Código: <code class="bg-dark text-white px-2 rounded">{{ $certificado->codigo_unico }}</code>
                    </small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('certificados.update', $certificado->id) }}" id="certificadoForm">
                        @csrf
                        @method('PUT')

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Enlace permanente:</strong> 
                            <a href="{{ route('certificados.show', $certificado->url_hash) }}" target="_blank" class="text-decoration-none">
                                {{ route('certificados.show', $certificado->url_hash) }}
                            </a>
                        </div>

                        <div class="row">
                            <!-- Información del Estudiante -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nombre Completo *</label>
                                <input type="text" 
                                       name="nombre_completo" 
                                       class="form-control @error('nombre_completo') is-invalid @enderror" 
                                       value="{{ old('nombre_completo', $certificado->nombre_completo) }}"
                                       required>
                                @error('nombre_completo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Correo Electrónico</label>
                                <input type="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $certificado->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Información del Curso -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Nombre del Curso *</label>
                                <input type="text" 
                                       name="nombre_curso" 
                                       class="form-control @error('nombre_curso') is-invalid @enderror" 
                                       value="{{ old('nombre_curso', $certificado->nombre_curso) }}"
                                       required>
                                @error('nombre_curso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha y Duración -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Fecha de Expedición *</label>
                                <input type="date" 
                                       name="fecha_expedicion" 
                                       class="form-control @error('fecha_expedicion') is-invalid @enderror" 
                                       value="{{ old('fecha_expedicion', $certificado->fecha_expedicion) }}"
                                       required>
                                @error('fecha_expedicion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Horas de Duración</label>
                                <input type="number" 
                                       name="horas_duracion" 
                                       class="form-control @error('horas_duracion') is-invalid @enderror" 
                                       value="{{ old('horas_duracion', $certificado->horas_duracion) }}">
                                @error('horas_duracion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Modalidad</label>
                                <select name="modalidad" class="form-select @error('modalidad') is-invalid @enderror">
                                    <option value="Virtual" {{ $certificado->modalidad == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                    <option value="Presencial" {{ $certificado->modalidad == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="Híbrido" {{ $certificado->modalidad == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                                </select>
                                @error('modalidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Habilidades -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-cogs text-primary me-1"></i>Habilidades Adquiridas
                                </label>
                                <div class="form-text mb-2">Agrega o elimina habilidades manualmente. Puedes separar cada una con coma o enter.</div>

                                <div class="border rounded p-3 bg-light">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="nuevaHabilidadInput" placeholder="Ej: Docker, CI/CD, Redis">
                                        <button type="button" class="btn btn-outline-primary" id="agregarHabilidadBtn">
                                            <i class="fas fa-plus me-1"></i>Agregar
                                        </button>
                                    </div>

                                    <div id="habilidadesList" class="d-flex flex-wrap gap-2"></div>
                                </div>

                                @php
                                    $habilidadesTexto = old('habilidades');
                                    if ($habilidadesTexto === null) {
                                        $habilidadesTexto = $certificado->habilidades_array;
                                        if (is_array($habilidadesTexto)) {
                                            $habilidadesTexto = implode(', ', $habilidadesTexto);
                                        }
                                    }
                                @endphp
                                <textarea name="habilidades" id="habilidadesInput" class="form-control mt-3 @error('habilidades') is-invalid @enderror" rows="3" placeholder="Apache, Laravel, Git">{{ $habilidadesTexto }}</textarea>
                                <div class="form-text">Se guardarán como registros separados y aparecerán en el certificado.</div>
                                @error('habilidades')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Configuración -->
                            <div class="col-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="publico" 
                                           id="publicoSwitch"
                                           value="1"
                                           {{ $certificado->publico ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="publicoSwitch">
                                        Certificado Público
                                    </label>
                                    <div class="form-text">Visible para cualquiera con el enlace</div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <a href="{{ route('certificados.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Cancelar
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('certificados.show', $certificado->url_hash) }}" 
                                   target="_blank"
                                   class="btn btn-primary">
                                    <i class="fas fa-eye me-2"></i>Ver Certificado
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i>Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const habilidadesInput = document.getElementById('habilidadesInput');
const nuevaHabilidadInput = document.getElementById('nuevaHabilidadInput');
const agregarHabilidadBtn = document.getElementById('agregarHabilidadBtn');
const habilidadesList = document.getElementById('habilidadesList');

function obtenerHabilidades() {
    return habilidadesInput.value
        .split(/\r\n|\n|,/) 
        .map(item => item.trim())
        .filter(Boolean);
}

function renderHabilidades() {
    const habilidades = obtenerHabilidades();
    habilidadesList.innerHTML = '';

    if (habilidades.length === 0) {
        habilidadesList.innerHTML = '<span class="text-muted">Aún no hay habilidades agregadas.</span>';
        return;
    }

    habilidades.forEach((skill, index) => {
        const badge = document.createElement('span');
        badge.className = 'badge bg-primary rounded-pill d-flex align-items-center gap-2 px-3 py-2';
        badge.innerHTML = `${skill}<button type="button" class="btn-close btn-close-white btn-sm" data-index="${index}" aria-label="Eliminar"></button>`;
        habilidadesList.appendChild(badge);
    });

    habilidadesList.querySelectorAll('button.btn-close').forEach(button => {
        button.addEventListener('click', () => {
            const index = Number(button.getAttribute('data-index'));
            const habilidades = obtenerHabilidades();
            habilidades.splice(index, 1);
            habilidadesInput.value = habilidades.join(', ');
            renderHabilidades();
        });
    });
}

function agregarHabilidad() {
    const texto = nuevaHabilidadInput.value.trim();
    if (!texto) {
        nuevaHabilidadInput.focus();
        return;
    }

    const habilidades = obtenerHabilidades();
    const nuevas = texto.split(/\r\n|\n|,/).map(item => item.trim()).filter(Boolean);
    const union = [...new Set([...habilidades, ...nuevas])];
    habilidadesInput.value = union.join(', ');
    nuevaHabilidadInput.value = '';
    renderHabilidades();
}

agregarHabilidadBtn.addEventListener('click', agregarHabilidad);
nuevaHabilidadInput.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        agregarHabilidad();
    }
});
habilidadesInput.addEventListener('input', renderHabilidades);

document.addEventListener('DOMContentLoaded', function() {
    renderHabilidades();
});
</script>
@endsection