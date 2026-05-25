<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-card {
            max-width: 450px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: white;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo-img {
            max-height: 70px;
            max-width: 180px;
            object-fit: contain;
        }
        .login-title {
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
        }
        .forgot-password {
            margin-top: 15px;
            text-align: center;
        }
        .forgot-password a {
            text-decoration: none;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .forgot-password a:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">
<div class="container">
    <div class="login-card">
        <div class="logo-container">
            <!-- Cambia esta ruta por la de tu logo -->
            <img src="{{ asset('images/logo_diremid.png') }}" alt="Logo SISMED" class="logo-img">
        </div>
        
        <h3 class="login-title text-center">Iniciar Sesión</h3>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            @error('email')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary w-100 mt-3">Entrar</button>
            
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
                <a href="https://aywsolution.com" >
                    Ir al Sitio Web
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>