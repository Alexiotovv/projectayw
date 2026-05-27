<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirma tu nuevo correo</title>
</head>
<body style="margin:0;padding:0;background:#f4f6fb;font-family:Arial,sans-serif;color:#1f2937;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="padding:24px 12px;background:#f4f6fb;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:640px;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">
                    <tr>
                        <td style="background:#0f766e;padding:22px 24px;color:#ffffff;">
                            <h1 style="margin:0;font-size:22px;line-height:1.3;">AYW Solution</h1>
                            <p style="margin:6px 0 0 0;font-size:14px;opacity:0.95;">Confirmacion de cambio de correo</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:24px 24px 10px 24px;">
                            <p style="margin:0 0 10px 0;font-size:16px;">Hola {{ $user->name }},</p>
                            <p style="margin:0 0 16px 0;line-height:1.65;color:#374151;">
                                Recibimos una solicitud para cambiar el correo de tu cuenta de AYW al siguiente email:
                                <strong>{{ $pendingEmail }}</strong>.
                            </p>
                            <p style="margin:0 0 16px 0;line-height:1.65;color:#374151;">
                                Para completar el cambio, confirma esta direccion haciendo clic en el boton. Tu correo actual no se modificara hasta que valides este enlace.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 20px 24px;text-align:center;">
                            <a href="{{ $verificationUrl }}" style="display:inline-block;background:#0f766e;color:#ffffff;text-decoration:none;padding:12px 22px;border-radius:8px;font-weight:700;">
                                Confirmar nuevo correo
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 24px 24px;">
                            <p style="margin:0 0 12px 0;line-height:1.6;color:#374151;">
                                Este enlace expirara en {{ $expireMinutes }} minutos. Si no solicitaste este cambio, puedes ignorar este mensaje y tu correo seguira siendo el actual.
                            </p>
                            <p style="margin:0;font-size:12px;color:#6b7280;word-break:break-all;line-height:1.6;">
                                Si el boton no funciona, copia y pega esta URL en tu navegador:<br>
                                {{ $verificationUrl }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#f9fafb;padding:14px 24px;font-size:12px;color:#6b7280;">
                            AYW Solution - Mensaje automatico, por favor no responder.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>