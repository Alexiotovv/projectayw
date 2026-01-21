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
                                <label class="form-label fw-bold">Habilidades Adquiridas</label>
                                <textarea name="habilidades" 
                                          class="form-control @error('habilidades') is-invalid @enderror" 
                                          rows="3">{{ old('habilidades', $certificado->habilidades) }}</textarea>
                                <div class="form-text">Separar por comas. Ej: Apache, Laravel, Git, MySQL</div>
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
@endsection