<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">
<div class="container">
    <div class="card shadow-sm mx-auto" style="max-width: 520px;">
        <div class="card-body p-4">
            <h4 class="mb-3">Recuperar contraseña</h4>
            <p class="text-muted">Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.</p>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Enviar enlace</button>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">Volver al login</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
