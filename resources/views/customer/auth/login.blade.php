@extends('bases.public_home')

@section('public_contenido')
<!-- Start Page Title Section -->
<div class="page-title-area page-title-bg">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>Iniciar Sesión</h2>
                    <ul>
                        <li><a href="{{ route('inicio') }}">Home</a></li>
                        <li>Clientes</li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Section -->

<!-- Start Login Section -->
<section class="login-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-12">
                <div class="login-form">
                    <div class="login-title">
                        <h3>Acceso al Panel de Clientes</h3>
                        <p>Ingresa tus credenciales para acceder a tus servicios</p>
                    </div>
                    
                    <form method="POST" action="{{ route('customer.login') }}" class="login-form-box">
                        @csrf
                        
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" placeholder="tu@email.com" required autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="********" required>
                                <button type="button" class="input-group-text toggle-password" data-target="password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Recordar mis datos</label>
                        </div>

                        <button type="submit" class="default-btn">
                            Iniciar Sesión <span></span>
                        </button>

                        <div class="text-center mt-4">
                            <p class="mb-2">
                                <a href="{{ route('customer.register') }}" class="text-primary">
                                    <i class="fas fa-user-plus me-1"></i> ¿No tienes cuenta? Regístrate aquí
                                </a>
                            </p>
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <i class="fas fa-key me-1"></i> ¿Olvidaste tu contraseña?
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login Section -->

<!-- Start Info Section -->
<section class="services-section pt-100 pb-70 bg-f9f9f9">
    <div class="container">
        <div class="section-title">
            <h6 class="sub-title">Servicios Disponibles</h6>
            <h2>Gestiona tus servicios de correo corporativo</h2>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="services-single-item">
                    <div class="services-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Correos Corporativos</h3>
                    <p>Administra tus cuentas de correo, espacio de almacenamiento y configuraciones.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="services-single-item">
                    <div class="services-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h3>Facturación y Pagos</h3>
                    <p>Consulta tus facturas, realiza pagos y lleva el control de tus transacciones.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="services-single-item">
                    <div class="services-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Soporte 24/7</h3>
                    <p>Accede a soporte técnico especializado para resolver cualquier inconveniente.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Info Section -->
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
</script>
@endsection