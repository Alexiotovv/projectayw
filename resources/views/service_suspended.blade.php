<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio suspendido | AYW Solution</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }
        .page-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }
        .message-card {
            width: 100%;
            max-width: 720px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            border-radius: 24px;
            padding: 36px;
        }
        .message-card h1 {
            margin: 0 0 16px;
            font-size: 32px;
            color: #0f172a;
        }
        .message-card p {
            margin: 0;
            line-height: 1.75;
            color: #334155;
        }
        .message-card p strong {
            color: #0f172a;
        }
        .message-card a {
            color: #0f766e;
            text-decoration: none;
            font-weight: 600;
        }
        .message-card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="message-card">
            <h1>Servicio suspendido</h1>
            <p>
                Su servicio ha sido suspendido, por favor regularice el pago ingresando a su panel de control en el siguiente enlace:
                <a href="https://aywsolution.com/customer/dashboard" target="_blank" rel="noopener">https://aywsolution.com/customer/dashboard</a>.
            </p>
            <p style="margin-top: 18px;">
                Para más información o asistencia, puede contactarnos a través de nuestro formulario de contacto en:
                <a href="https://aywsolution.com/contacto/index" target="_blank" rel="noopener">https://aywsolution.com/contacto/index</a>.
            </p>
        </div>
    </div>
</body>
</html>
