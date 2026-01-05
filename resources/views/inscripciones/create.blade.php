@extends('bases.public_home')

@section('public_contenido')
{{-- <style>
    .default-btn.submit-btn {
    min-height: 50px;
    padding: 12px 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Asegurar que el texto y spinner estén alineados */
#btn-text, #spinner {
    line-height: 1;
}

/* Contenedor para alinear contenido */
#submit-btn span:not(.spinner-border) {
    display: inline-block;
    vertical-align: middle;
} --}}
</style>
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>Inscripción al Curso</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">Home</a></li>
                        <li>Inscripción</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-section section-padding">
    <div class="container">
        <div class="section-title">
            <h6 class="sub-title">Formulario de Inscripción</h6>
            <h2>Regístrate al Curso Taller</h2>
            <p>Completa todos los campos para reservar tu cupo</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="contact-form">
                    <div id="message" class="alert d-none"></div>
                    
                    <form id="inscripcionForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="modalidad">Modalidad *</label>
                                    <select name="modalidad" id="modalidad" class="form-control">
                                        <option value="">Selecciona modalidad</option>
                                        <option value="virtual">Virtual (S/ 50.00)</option>
                                        <option value="presencial">Presencial (S/ 80.00)</option>
                                    </select>
                                    <small class="text-danger" id="modalidad-error"></small>
                                </div>
                            </div>
                        

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nombres">Nombres *</label>
                                    <input type="text" name="nombres" id="nombres" class="form-control" 
                                            placeholder="Ingresa tus nombres">
                                    <small class="text-danger" id="nombres-error"></small>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos *</label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control" 
                                           placeholder="Ingresa tus apellidos">
                                    <small class="text-danger" id="apellidos-error"></small>
                                </div>
                            </div>
                        
                            <div class="col-lg-4">
                                <label for="email" class="form-label">Correo Electrónico *</label>
                                <input type="email" 
                                    class="form-control" 
                                    id="email" 
                                    name="email" 
                                    required
                                    placeholder="ejemplo@correo.com">
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>
                        
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="voucher">Voucher de Pago *</label>
                                    <div class="custom-file">
                                        <input type="file" name="voucher" id="voucher" 
                                               class="custom-file-input" accept="image/*">
                                        <label class="custom-file-label" for="voucher">Selecciona una imagen del voucher</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Sube una imagen del comprobante de pago (PLIN/YAPE 980534198) Alex Vasquez
                                    </small>
                                    <small class="text-danger" id="voucher-error"></small>
                                    
                                    <div id="voucher-preview" class="mt-2 d-none">
                                        <img id="preview-image" src="#" alt="Voucher preview" 
                                             style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="terminos" required>
                                        <label class="form-check-label" for="terminos">
                                            Acepto los términos y condiciones del curso
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            id="submit-btn"
						   target="_blank"
						   class="default-btn submit-btn mt-3">
							Enviar Inscripción
                            <span></span>
                            {{-- <span id="btn-text">Enviar Inscripción</span> --}}
                            <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>


                        
                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_footer')
<script>
$(document).ready(function() {
    // Preview de imagen
    $('#voucher').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
                $('#voucher-preview').removeClass('d-none');
            }
            reader.readAsDataURL(file);
            
            // Mostrar nombre del archivo
            $(this).next('.custom-file-label').text(file.name);
        }
    });

    // Envío del formulario con AJAX
    $('#inscripcionForm').on('submit', function(e) {
        e.preventDefault();
        
        // Mostrar spinner
        $('#submit-btn').prop('disabled', true);
        $('#btn-text').text('Procesando...');
        $('#spinner').removeClass('d-none');
        
        // Limpiar errores previos
        $('.text-danger').text('');
        $('#message').addClass('d-none');
        
        // Crear FormData
        let formData = new FormData(this);
        
        $.ajax({
            url: '{{ route("inscripcion.curso.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    // Mostrar mensaje de éxito
                    $('#message').removeClass('d-none alert-danger').addClass('alert-success')
                                .html('<strong>¡Éxito!</strong> ' + response.message);
                    
                    // Resetear formulario
                    $('#inscripcionForm')[0].reset();
                    $('#voucher-preview').addClass('d-none');
                    $('.custom-file-label').text('Selecciona una imagen del voucher');
                    
                    // Redirigir después de 3 segundos
                    setTimeout(function() {
                        window.location.href = '{{ route("inicio") }}';
                    }, 3000);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Mostrar errores de validación
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#' + key + '-error').text(value[0]);
                    });
                    
                    $('#message').removeClass('d-none alert-success').addClass('alert-danger')
                                .html('<strong>Error:</strong> Por favor corrige los errores del formulario.');
                } else {
                    $('#message').removeClass('d-none alert-success').addClass('alert-danger')
                                .html('<strong>Error:</strong> Ocurrió un problema al procesar tu inscripción.');
                }
            },
            complete: function() {
                // Restaurar botón
                $('#submit-btn').prop('disabled', false);
                $('#btn-text').text('Enviar Inscripción');
                $('#spinner').addClass('d-none');
            }
        });
    });
});
</script>
@endsection