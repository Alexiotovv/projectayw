{{-- resources/views/certificados/create.blade.php --}}
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
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Certificado</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Generar Nuevo Certificado
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('certificados.store') }}" id="certificadoForm">
                        @csrf

                        <div class="row">
                            <!-- Información del Estudiante -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user text-primary me-1"></i>Nombre Completo *
                                </label>
                                <input type="text" 
                                       name="nombre_completo" 
                                       class="form-control @error('nombre_completo') is-invalid @enderror" 
                                       value="{{ old('nombre_completo') }}"
                                       placeholder="Ej: Juan Pérez García"
                                       required
                                       autofocus>
                                @error('nombre_completo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-envelope text-primary me-1"></i>Correo Electrónico
                                </label>
                                <input type="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}"
                                       placeholder="ejemplo@correo.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Información del Curso -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-book text-primary me-1"></i>Nombre del Curso *
                                </label>
                                <input type="text" 
                                       name="nombre_curso" 
                                       class="form-control @error('nombre_curso') is-invalid @enderror" 
                                       value="{{ old('nombre_curso', 'Curso Taller: Implementación de un VPS + Laravel, desde cero') }}"
                                       required>
                                @error('nombre_curso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha y Duración -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-calendar-alt text-primary me-1"></i>Fecha de Expedición *
                                </label>
                                <input type="date" 
                                       name="fecha_expedicion" 
                                       class="form-control @error('fecha_expedicion') is-invalid @enderror" 
                                       value="{{ old('fecha_expedicion', date('Y-m-d')) }}"
                                       required>
                                @error('fecha_expedicion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-clock text-primary me-1"></i>Horas de Duración
                                </label>
                                <input type="number" 
                                       name="horas_duracion" 
                                       class="form-control @error('horas_duracion') is-invalid @enderror" 
                                       value="{{ old('horas_duracion', 6) }}"
                                       min="1"
                                       max="2000">
                                @error('horas_duracion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-laptop-house text-primary me-1"></i>Modalidad
                                </label>
                                <select name="modalidad" class="form-select @error('modalidad') is-invalid @enderror">
                                    <option value="Virtual" {{ old('modalidad', 'Virtual') == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                    <option value="Presencial" {{ old('modalidad') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="Híbrido" {{ old('modalidad') == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
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
                                <div class="form-text mb-2">Escribe o agrega nuevas habilidades manualmente. Puedes separar cada una con coma o enter.</div>

                                <div class="border rounded p-3 bg-light">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="nuevaHabilidadInput" placeholder="Ej: Docker, CI/CD, Redis">
                                        <button type="button" class="btn btn-outline-primary" id="agregarHabilidadBtn">
                                            <i class="fas fa-plus me-1"></i>Agregar
                                        </button>
                                    </div>

                                    <div id="habilidadesList" class="d-flex flex-wrap gap-2"></div>
                                </div>

                                <textarea name="habilidades" id="habilidadesInput" class="form-control mt-3" rows="3" placeholder="Apache, Laravel, Git">{{ old('habilidades') }}</textarea>
                                <div class="form-text">Se guardarán como registros separados y aparecerán en el certificado.</div>
                            </div>

                            <!-- Configuración Avanzada -->
                            <div class="col-12 mb-3">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold">
                                            <i class="fas fa-sliders-h text-primary me-1"></i>Configuración Avanzada
                                        </h6>
                                        
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" 
                                                           type="checkbox" 
                                                           name="publico" 
                                                           id="publicoSwitch"
                                                           value="1"
                                                           checked>
                                                    <label class="form-check-label" for="publicoSwitch">
                                                        <i class="fas fa-eye me-1"></i>Certificado Público
                                                    </label>
                                                    <div class="form-text">Visible para cualquiera con el enlace</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" 
                                                           type="checkbox" 
                                                           name="enviar_email" 
                                                           id="emailSwitch"
                                                           value="1">
                                                    <label class="form-check-label" for="emailSwitch">
                                                        <i class="fas fa-paper-plane me-1"></i>Enviar por correo
                                                    </label>
                                                    <div class="form-text">Solo si se proporcionó email</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista Previa -->
                            <div class="col-12 mb-4">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-eye me-1"></i>Vista Previa
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="vistaPrevia" class="p-3 border rounded bg-white">
                                            <div class="text-center">
                                                <h5 class="fw-bold text-primary" id="previewNombre">
                                                    {{ old('nombre_completo', 'Nombre del Estudiante') }}
                                                </h5>
                                                <p class="mb-1" id="previewCurso">
                                                    {{ old('nombre_curso', 'Curso Taller: Implementación de un VPS + Laravel, desde cero') }}
                                                </p>
                                                <p class="text-muted small" id="previewFecha">
                                                    {{ old('fecha_expedicion', date('d/m/Y')) }}
                                                </p>
                                                <div class="mt-2" id="previewHabilidades">
                                                    <span class="badge bg-secondary">Apache</span>
                                                    <span class="badge bg-secondary">Laravel</span>
                                                    <span class="badge bg-secondary">Git</span>
                                                    <span class="badge bg-secondary">+ más</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <button type="button" class="btn btn-outline-primary" id="previewBtn">
                                    <i class="fas fa-eye me-2"></i>Vista Previa Completa
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i>Generar Certificado
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
            actualizarVistaPrevia();
        });
    });

    actualizarVistaPrevia();
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

// Actualizar vista previa en tiempo real
document.querySelectorAll('#certificadoForm input, #certificadoForm select, #certificadoForm textarea').forEach(element => {
    element.addEventListener('change', actualizarVistaPrevia);
    element.addEventListener('keyup', actualizarVistaPrevia);
});

function actualizarVistaPrevia() {
    // Nombre
    const nombreInput = document.querySelector('input[name="nombre_completo"]');
    if (nombreInput) {
        document.getElementById('previewNombre').textContent = 
            nombreInput.value || 'Nombre del Estudiante';
    }
    
    // Curso
    const cursoInput = document.querySelector('input[name="nombre_curso"]');
    if (cursoInput) {
        document.getElementById('previewCurso').textContent = 
            cursoInput.value || 'Nombre del Curso';
    }
    
    // Fecha
    const fechaInput = document.querySelector('input[name="fecha_expedicion"]');
    if (fechaInput.value) {
        const fecha = new Date(fechaInput.value);
        document.getElementById('previewFecha').textContent = 
            fecha.toLocaleDateString('es-ES');
    }

    const habilidades = obtenerHabilidades();
    const previewHabilidades = document.getElementById('previewHabilidades');
    if (previewHabilidades) {
        previewHabilidades.innerHTML = '';
        if (habilidades.length > 0) {
            habilidades.slice(0, 4).forEach(skill => {
                previewHabilidades.innerHTML += `<span class="badge bg-secondary me-1">${skill}</span>`;
            });
            if (habilidades.length > 4) {
                previewHabilidades.innerHTML += `<span class="badge bg-secondary">+ ${habilidades.length - 4} más</span>`;
            }
        } else {
            previewHabilidades.innerHTML = '<span class="badge bg-secondary">Sin habilidades</span>';
        }
    }
}

// Botón de vista previa completa
document.getElementById('previewBtn').addEventListener('click', function(e) {
    e.preventDefault();
    
    // Crear datos del formulario
    const formData = new FormData(document.getElementById('certificadoForm'));
    const data = {};
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    // Guardar en sessionStorage y abrir ventana
    sessionStorage.setItem('previewData', JSON.stringify(data));
    window.open('{{ route("certificados.preview") }}', '_blank');
});

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    if (!habilidadesInput.value) {
        habilidadesInput.value = 'Apache, Laravel, Git';
    }
    renderHabilidades();
    actualizarVistaPrevia();
    
    // Configurar fecha mínima (últimos 2 años)
    const fechaInput = document.querySelector('input[name="fecha_expedicion"]');
    const hoy = new Date();
    const haceDosAnos = new Date();
    haceDosAnos.setFullYear(hoy.getFullYear() - 2);
    
    fechaInput.min = haceDosAnos.toISOString().split('T')[0];
    fechaInput.max = hoy.toISOString().split('T')[0];
});
</script>
@endsection