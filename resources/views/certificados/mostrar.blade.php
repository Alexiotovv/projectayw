{{-- resources/views/certificados/mostrar.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado - {{ $certificado->nombre_completo }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .certificate-container {
            max-width: 900px;
            margin: 0 auto;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 20px solid #0d6efd;
            border-image: linear-gradient(45deg, #0d6efd, #198754) 1;
            position: relative;
            overflow: hidden;
        }
        
        .certificate-header {
            background: linear-gradient(90deg, #0d6efd, #198754);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        
        .watermark {
            position: absolute;
            opacity: 0.05;
            font-size: 20rem;
            transform: rotate(-45deg);
            top: 30%;
            left: 10%;
            color: #0d6efd;
            pointer-events: none;
            z-index: 1;
        }
        
        .certificate-body {
            padding: 3rem;
            position: relative;
            z-index: 2;
            background: white;
        }
        
        .certificate-logo {
            width: 150px;
            margin-bottom: 2rem;
        }
        
        .signature-section {
            margin-top: 3rem;
            border-top: 2px solid #dee2e6;
            padding-top: 1.5rem;
        }
        
        .verification-code {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            font-family: monospace;
            letter-spacing: 2px;
        }
        
        .skills-badge {
            background: #e9ecef;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            display: inline-block;
            font-size: 0.9rem;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
            .certificate-container {
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="certificate-container shadow-lg">
            <div class="watermark">
                <i class="fas fa-certificate"></i>
            </div>
            
            <div class="certificate-header">
                <h1 class="display-4 fw-bold">
                    <i class="fas fa-award me-2"></i>CERTIFICADO DE COMPLETACIÓN
                </h1>
                <p class="lead mb-0">Otorgado a</p>
            </div>
            
            <div class="certificate-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="certificate-logo">
                </div>
                
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary mb-3">
                        {{ $certificado->nombre_completo }}
                    </h2>
                    <p class="lead">Ha completado exitosamente el curso</p>
                    <h3 class="fw-bold text-dark">{{ $certificado->nombre_curso }}</h3>
                </div>
                
                <div class="row mb-5">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Detalles del Curso
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <strong>Fecha de Expedición:</strong><br>
                                {{ date('d/m/Y', strtotime($certificado->fecha_expedicion)) }}
                            </li>
                            <li class="mb-2">
                                <strong>Duración:</strong><br>
                                {{ $certificado->horas_duracion }} horas
                            </li>
                            <li class="mb-2">
                                <strong>Modalidad:</strong><br>
                                {{ $certificado->modalidad ?? 'Virtual' }}
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-cogs me-2 text-primary"></i>Habilidades Adquiridas
                        </h5>
                        <div class="mt-2">
                            @foreach($certificado->habilidades_array as $skill)
                                <span class="skills-badge">
                                    <i class="fas fa-check-circle me-1 text-success"></i>{{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="signature-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/firma_alex.png') }}" 
                                     alt="Firma" 
                                     style="height: 80px;"
                                     class="mb-2">
                                <div class="border-top pt-2">
                                    <strong>{{ $certificado->instructor }}</strong><br>
                                    <small>Instructor & DevOps Specialist</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="verification-code mb-3">
                                    Código: {{ $certificado->codigo_unico }}
                                </div>
                                <small class="text-muted">
                                    Verificar en:<br>
                                    {{ route('certificado.verificar') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-4 text-center no-print">
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <a href="{{ route('certificado.pdf', $certificado->url_hash) }}" 
                   class="btn btn-outline-primary">
                    <i class="fas fa-file-pdf me-2"></i>Descargar PDF
                </a>
                <button onclick="window.print()" class="btn btn-outline-success">
                    <i class="fas fa-print me-2"></i>Imprimir Certificado
                </button>
                <a href="{{ route('certificado.verificar') }}" class="btn btn-outline-info">
                    <i class="fas fa-share me-2"></i>Compartir Enlace
                </a>
            </div>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Enlace permanente:</strong> 
                <a href="{{ $certificado->url_certificado }}" class="text-decoration-none">
                    {{ $certificado->url_certificado }}
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Copiar enlace al portapapeles
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Enlace copiado al portapapeles');
            });
        }
    </script>
</body>
</html>