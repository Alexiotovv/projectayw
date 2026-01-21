{{-- resources/views/certificados/index.blade.php --}}
@extends('bases.admin_base')

@section('admin_contenido')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">
                            <i class="fas fa-certificate me-2 text-primary"></i>Certificados Emitidos
                        </h4>
                        <p class="text-muted mb-0">Gestión de certificados digitales</p>
                    </div>
                    <a href="{{ route('certificados.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Certificado
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($certificados->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-certificate fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay certificados registrados</h5>
                            <p class="text-muted">Comienza creando tu primer certificado</p>
                            <a href="{{ route('certificados.create') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-plus me-2"></i>Crear Primer Certificado
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th><i class="fas fa-user me-1"></i> Estudiante</th>
                                        <th><i class="fas fa-book me-1"></i> Curso</th>
                                        <th><i class="fas fa-calendar me-1"></i> Fecha</th>
                                        <th><i class="fas fa-hashtag me-1"></i> Código</th>
                                        <th><i class="fas fa-eye me-1"></i> Estado</th>
                                        <th><i class="fas fa-cogs me-1"></i> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certificados as $certificado)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                        <span class="text-white fw-bold">
                                                            {{ substr($certificado->nombre_completo, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $certificado->nombre_completo }}</h6>
                                                        @if($certificado->email)
                                                            <small class="text-muted">{{ $certificado->email }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-semibold">{{ $certificado->nombre_curso }}</span>
                                                <br>
                                                <small class="text-muted">
                                                    {{ $certificado->horas_duracion }} horas • {{ $certificado->modalidad }}
                                                </small>
                                            </td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($certificado->fecha_expedicion)) }}
                                            </td>
                                            <td>
                                                <code class="bg-light p-1 rounded">{{ $certificado->codigo_unico }}</code>
                                                <br>
                                                <small class="text-muted">Hash: {{ substr($certificado->url_hash, 0, 8) }}...</small>
                                            </td>
                                            <td>
                                                @if($certificado->publico)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-eye me-1"></i>Público
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-eye-slash me-1"></i>Privado
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('certificados.show', $certificado->url_hash) }}" 
                                                       target="_blank"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Ver Certificado">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('certificados.edit', $certificado->id) }}" 
                                                       class="btn btn-sm btn-outline-warning"
                                                       title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-info"
                                                            onclick="copiarEnlace('{{ route('certificados.show', $certificado->url_hash) }}')"
                                                            title="Copiar Enlace">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                    <form action="{{ route('certificados.destroy', $certificado->id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('¿Eliminar este certificado?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger"
                                                                title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $certificados->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copiarEnlace(enlace) {
    navigator.clipboard.writeText(enlace).then(() => {
        alert('Enlace copiado al portapapeles: ' + enlace);
    });
}

function copiarCodigo(codigo) {
    navigator.clipboard.writeText(codigo).then(() => {
        alert('Código copiado: ' + codigo);
    });
}
</script>
@endsection