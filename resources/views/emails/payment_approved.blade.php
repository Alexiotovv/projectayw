<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago confirmado</title>
</head>
<body style="margin:0;padding:0;background:#f4f6fb;font-family:Arial,sans-serif;color:#1f2937;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="padding:24px 12px;background:#f4f6fb;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:640px;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">
                    <tr>
                        <td style="background:#0f766e;padding:22px 24px;color:#ffffff;">
                            <h1 style="margin:0;font-size:22px;line-height:1.3;">AYW Solution</h1>
                            <p style="margin:6px 0 0 0;font-size:14px;opacity:0.95;">Pago confirmado con éxito</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:24px 24px 10px 24px;">
                            <p style="margin:0 0 10px 0;font-size:16px;">Hola {{ $payment->user?->name ?? 'cliente' }},</p>
                            <p style="margin:0 0 16px 0;line-height:1.65;color:#374151;">
                                El pago asociado a tu servicio ha sido confirmado correctamente. Aquí tienes los datos del comprobante.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 16px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #e5e7eb;border-radius:10px;background:#f9fafb;">
                                <tr>
                                    <td style="padding:16px 18px;border-bottom:1px solid #e5e7eb;">
                                        <h2 style="margin:0;font-size:16px;color:#111827;">Resumen del pago</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;">
                                        <p style="margin:0 0 8px 0;"><strong>Factura:</strong> FAC-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Servicio:</strong> {{ $payment->service?->name ?? 'No disponible' }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Monto:</strong> S/. {{ number_format($payment->amount, 2) }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Método:</strong> {{ strtoupper($payment->payment_method) }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Fecha de pago:</strong> {{ $payment->payment_date?->format('d/m/Y') }}</p>
                                        <p style="margin:0;"><strong>Descripción:</strong> Pago confirmado para el servicio {{ $payment->service?->plan ?? 'N/A' }}.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 18px 24px;">
                            <p style="margin:0 0 8px 0;line-height:1.6;color:#374151;">
                                Si necesitas descargar el comprobante o revisar el estado del servicio, ingresa a tu panel de cliente en la sección "Mis Pagos".
                            </p>
                            <p style="margin:0;line-height:1.6;color:#374151;">
                                Gracias por confiar en AYW.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#f9fafb;padding:14px 24px;font-size:12px;color:#6b7280;">
                            AYW Solution - Mensaje automático, por favor no responder.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
