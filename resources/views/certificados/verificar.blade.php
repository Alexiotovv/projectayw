{{-- resources/views/certificados/verificar.blade.php --}}
@extends('bases.public_home')

@section('public_contenido')
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>Verificar Certificado</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">Home</a></li>
                        <li>Verificar Certificado</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="contact-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-award fa-3x text-primary mb-3"></i>
                            <h3 class="mb-2">Verificar Certificado</h3>
                            <p class="text-muted">Ingresa el código único de tu certificado</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('certificado.buscar') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="codigo" class="form-label">Código del Certificado</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-hashtag"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="codigo" 
                                           name="codigo" 
                                           placeholder="Ej: ABC123DEF456" 
                                           required
                                           autofocus>
                                </div>
                                <div class="form-text">
                                    El código se encuentra en la parte inferior de tu certificado
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-search me-2"></i> Verificar Certificado
                            </button>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-2">
                                <small class="text-muted">
                                    ¿No tienes un código? 
                                    <a href="{{ route('contacto.index') }}">Contáctanos</a>
                                </small>
                            </p>
                            <p class="mb-0">
                                <small class="text-muted">
                                    Ejemplo de código: <code>VPSLAR-XXXX-XXXX</code>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <a href="#" class="text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i> Volver al Curso VPS + Laravel
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection