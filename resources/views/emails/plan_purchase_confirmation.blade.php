<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de compra de plan</title>
</head>
<body style="margin:0;padding:0;background:#f4f6fb;font-family:Arial,sans-serif;color:#1f2937;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="padding:24px 12px;background:#f4f6fb;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:640px;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">
                    <tr>
                        <td style="background:#0f766e;padding:22px 24px;color:#ffffff;">
                            <h1 style="margin:0;font-size:22px;line-height:1.3;">AYW Solution</h1>
                            <p style="margin:6px 0 0 0;font-size:14px;opacity:0.95;">Confirmación de compra de plan</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:24px 24px 10px 24px;">
                            <p style="margin:0 0 10px 0;font-size:16px;">Hola {{ $user->name }},</p>
                            <p style="margin:0 0 16px 0;line-height:1.65;color:#374151;">
                                Tu solicitud fue recibida correctamente. Te compartimos el detalle de tu plan y del pago para que puedas continuar con tranquilidad.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 16px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #e5e7eb;border-radius:10px;background:#f9fafb;">
                                <tr>
                                    <td style="padding:16px 18px;border-bottom:1px solid #e5e7eb;">
                                        <h2 style="margin:0;font-size:16px;color:#111827;">Resumen del plan</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;">
                                        <p style="margin:0 0 8px 0;"><strong>Plan:</strong> {{ $servicePlan->name }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Tipo:</strong> {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $servicePlan->type)) }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Precio:</strong> S/. {{ number_format($servicePlan->price, 2) }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Ciclo:</strong> {{ $servicePlan->billing_cycle === 'yearly' ? 'Anual' : 'Mensual' }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Servicio:</strong> {{ $service->name }}</p>
                                        <p style="margin:0;"><strong>Dominio:</strong> {{ $service->domain ?: 'N/A' }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 16px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #e5e7eb;border-radius:10px;background:#ffffff;">
                                <tr>
                                    <td style="padding:16px 18px;border-bottom:1px solid #e5e7eb;background:#f9fafb;">
                                        <h2 style="margin:0;font-size:16px;color:#111827;">Detalle de pago</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;">
                                        <p style="margin:0 0 8px 0;"><strong>Referencia:</strong> FAC-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Monto:</strong> S/. {{ number_format($payment->amount, 2) }}</p>
                                        <p style="margin:0 0 8px 0;"><strong>Método:</strong> {{ $paymentMethod->name }}</p>
                                        <p style="margin:0;"><strong>Estado:</strong> {{ ucfirst($payment->status) }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    @if($paymentMethod->instructions)
                    <tr>
                        <td style="padding:0 24px 16px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-left:4px solid #0f766e;background:#ecfeff;border-radius:8px;">
                                <tr>
                                    <td style="padding:14px 16px;line-height:1.6;color:#0f172a;">
                                        <strong>Instrucciones de pago:</strong><br>
                                        {{ $paymentMethod->instructions }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    @if($paymentMethod->type === 'qr' && $paymentMethod->qr_image_url)
                    <tr>
                        <td style="padding:0 24px 16px 24px;text-align:center;">
                            <p style="margin:0 0 10px 0;"><strong>Código QR para completar tu pago</strong></p>
                            <img src="{{ $paymentMethod->qr_image_url }}" alt="Código QR" style="display:inline-block;max-width:220px;width:100%;border:1px solid #d1d5db;border-radius:10px;">
                        </td>
                    </tr>
                    @endif

                    @if($paymentMethod->type === 'transfer')
                    <tr>
                        <td style="padding:0 24px 16px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #e5e7eb;border-radius:10px;background:#f9fafb;">
                                <tr>
                                    <td style="padding:14px 16px;">
                                        <p style="margin:0 0 8px 0;"><strong>Datos para transferencia</strong></p>
                                        <p style="margin:0 0 6px 0;"><strong>Banco:</strong> {{ $paymentMethod->bank_name ?: 'N/A' }}</p>
                                        <p style="margin:0 0 6px 0;"><strong>Titular:</strong> {{ $paymentMethod->bank_account_holder ?: 'N/A' }}</p>
                                        <p style="margin:0 0 6px 0;"><strong>N° Cuenta:</strong> {{ $paymentMethod->bank_account_number ?: 'N/A' }}</p>
                                        <p style="margin:0;"><strong>CCI:</strong> {{ $paymentMethod->bank_account_cci ?: 'N/A' }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    @if($paymentMethod->type === 'card')
                    <tr>
                        <td style="padding:0 24px 18px 24px;text-align:center;">
                            @if($paymentMethod->gateway_url)
                            <a href="{{ $paymentMethod->gateway_url }}" style="display:inline-block;background:#0f766e;color:#ffffff;text-decoration:none;padding:12px 22px;border-radius:8px;font-weight:700;">
                                Ir a pasarela de pago
                            </a>
                            @else
                            <p style="margin:0;color:#4b5563;">No hay enlace de pasarela configurado. Contáctanos para completar el pago.</p>
                            @endif
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td style="padding:0 24px 24px 24px;">
                            <p style="margin:0 0 8px 0;line-height:1.6;color:#374151;">
                                Puedes ingresar a tu panel para subir tu comprobante y dar seguimiento a tu solicitud.
                            </p>
                            <p style="margin:0;line-height:1.6;color:#374151;">
                                Gracias por confiar en AYW.
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
