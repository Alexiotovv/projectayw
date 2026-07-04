<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu certificado está listo</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f7fb;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
    <div style="max-width:620px;margin:32px auto;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);">
        <div style="background:linear-gradient(135deg,#2563eb,#4f46e5);padding:28px 32px;color:#fff;">
            <h1 style="margin:0;font-size:24px;">Tu certificado ya está listo</h1>
            <p style="margin:8px 0 0;font-size:15px;opacity:0.95;">Hola {{ $certificado->nombre_completo ?? 'estimado(a)' }}, aquí tienes tu acceso al certificado digital.</p>
        </div>
        <div style="padding:32px;">
            <p style="margin:0 0 12px;line-height:1.6;">Has finalizado el curso <strong>{{ $certificado->nombre_curso }}</strong> y tu certificado está disponible para verlo o descargarlo.</p>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px 18px;margin:20px 0;">
                <p style="margin:0 0 6px;font-size:13px;text-transform:uppercase;letter-spacing:0.08em;color:#64748b;">Enlace de acceso</p>
                <a href="{{ $enlace }}" style="font-size:16px;color:#2563eb;text-decoration:none;word-break:break-all;">{{ $enlace }}</a>
            </div>
            <p style="margin:0 0 16px;line-height:1.6;">Si el botón no funciona, copia y pega el enlace en tu navegador.</p>
            <a href="{{ $enlace }}" style="display:inline-block;background:#2563eb;color:#fff;text-decoration:none;padding:12px 20px;border-radius:999px;font-weight:bold;">Ver mi certificado</a>
        </div>
        <div style="padding:20px 32px 32px;font-size:12px;color:#94a3b8;text-align:center;">
            <div>Este mensaje fue enviado por AYW. Si tienes dudas, contáctanos.</div>
            <div style="margin-top:6px;"><a href="https://ayw.com.pe/contacto" style="color:#2563eb;text-decoration:none;">Contactar con AYW</a></div>
        </div>
    </div>
</body>
</html>
