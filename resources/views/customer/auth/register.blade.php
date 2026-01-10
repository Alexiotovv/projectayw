@extends('bases.public_home')

@section('public_contenido')
<!-- Start Page Title Section -->
<div class="page-title-area page-title-bg">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>Registro de Cliente</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">Home</a></li>
                        <li>Clientes</li>
                        <li>Registro</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Section -->

<!-- Start Register Section -->
<section class="register-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
                <div class="register-form">
                    <div class="register-title">
                        <h3>Crear Cuenta de Cliente</h3>
                        <p>Completa el formulario para acceder a nuestros servicios</p>
                    </div>
                    
                    <form method="POST" action="{{ route('customer.register') }}" class="register-form-box">
                        @csrf
                        
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre Completo *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" placeholder="Juan Pérez" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Empresa / Organización *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <input type="text" id="company" name="company" class="form-control @error('company') is-invalid @enderror" 
                                               value="{{ old('company') }}" placeholder="Mi Empresa SAC" required>
                                    </div>
                                    @error('company')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" placeholder="contacto@empresa.com" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Teléfono *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone') }}" placeholder="+51 987 654 321" required>
                                    </div>
                                    @error('phone')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Contraseña *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Mínimo 8 caracteres" required>
                                        <button type="button" class="input-group-text toggle-password" data-target="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Contraseña *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" id="password_confirmation" name="password_confirmation" 
                                               class="form-control" placeholder="Repite tu contraseña" required>
                                        <button type="button" class="input-group-text toggle-password" data-target="password_confirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" 
                                   id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                Acepto los <a href="#" class="text-primary">Términos y Condiciones</a> 
                                y la <a href="#" class="text-primary">Política de Privacidad</a>
                            </label>
                            @error('terms')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter">
                                Deseo recibir información sobre nuevos servicios y promociones
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="default-btn me-3">
                                Crear Cuenta <span></span>
                            </button>
                            
                            <a href="{{ route('customer.login') }}" class="default-btn btn-secondary">
                                <i class="fas fa-sign-in-alt me-2"></i>Ya tengo cuenta
                            </a>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted small mb-0">
                                <i class="fas fa-shield-alt me-2"></i>
                                Tus datos están protegidos y nunca serán compartidos con terceros.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Register Section -->

<!-- Start Benefits Section -->
<section class="services-section pt-100 pb-70 bg-f9f9f9">
    <div class="container">
        <div class="section-title">
            <h6 class="sub-title">Beneficios de ser cliente</h6>
            <h2>¿Por qué registrarte en AYW?</h2>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="services-single-item text-center">
                    <div class="services-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Activación Rápida</h3>
                    <p>Servicios activos en menos de 24 horas después del pago.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="services-single-item text-center">
                    <div class="services-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Soporte Dedicado</h3>
                    <p>Atención personalizada vía WhatsApp, email y telefónica.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="services-single-item text-center">
                    <div class="services-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Panel de Control</h3>
                    <p>Gestiona todos tus servicios desde un solo lugar.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="services-single-item text-center">
                    <div class="services-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Seguridad Garantizada</h3>
                    <p>Protección antivirus y antispam en todos los correos.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Benefits Section -->
@endsection

@section('script_footer')
<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Form validation
    document.querySelector('.register-form-box').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const terms = document.getElementById('terms').checked;
        
        // Password validation
        if (password.length < 8) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 8 caracteres');
            return false;
        }
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
            return false;
        }
        
        if (!terms) {
            e.preventDefault();
            alert('Debes aceptar los términos y condiciones');
            return false;
        }
        
        return true;
    });
</script>
@endsection