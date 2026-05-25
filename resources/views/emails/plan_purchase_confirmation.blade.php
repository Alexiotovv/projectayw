<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de solicitud</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.5;">
    <h2>Hola {{ $user->name }},</h2>
    <p>Recibimos tu solicitud correctamente. Este es el resumen:</p>

    <h3>Plan solicitado</h3>
    <ul>
        <li><strong>Plan:</strong> {{ $servicePlan->name }}</li>
        <li><strong>Tipo:</strong> {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $servicePlan->type)) }}</li>
        <li><strong>Precio:</strong> S/. {{ number_format($servicePlan->price, 2) }}</li>
        <li><strong>Ciclo:</strong> {{ $servicePlan->billing_cycle === 'yearly' ? 'Anual' : 'Mensual' }}</li>
        <li><strong>Servicio:</strong> {{ $service->name }}</li>
        <li><strong>Dominio:</strong> {{ $service->domain ?: 'N/A' }}</li>
    </ul>

    <h3>Pago</h3>
    <ul>
        <li><strong>Referencia:</strong> FAC-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</li>
        <li><strong>Monto:</strong> S/. {{ number_format($payment->amount, 2) }}</li>
        <li><strong>Método:</strong> {{ $paymentMethod->name }}</li>
        <li><strong>Estado:</strong> {{ $payment->status }}</li>
    </ul>

    @if($paymentMethod->instructions)
    <p><strong>Instrucciones de pago:</strong><br>{{ $paymentMethod->instructions }}</p>
    @endif

    @if($paymentMethod->type === 'qr' && $paymentMethod->qr_image_url)
    <p><strong>Código QR para pago:</strong></p>
    <p>
        <img src="{{ $paymentMethod->qr_image_url }}" alt="Código QR" style="max-width: 220px; width: 100%; border: 1px solid #ddd; border-radius: 8px;">
    </p>
    @endif

    @if($paymentMethod->type === 'transfer')
    <p><strong>Datos bancarios para transferencia:</strong></p>
    <ul>
        <li><strong>Banco:</strong> {{ $paymentMethod->bank_name ?: 'N/A' }}</li>
        <li><strong>Titular:</strong> {{ $paymentMethod->bank_account_holder ?: 'N/A' }}</li>
        <li><strong>N° Cuenta:</strong> {{ $paymentMethod->bank_account_number ?: 'N/A' }}</li>
        <li><strong>CCI:</strong> {{ $paymentMethod->bank_account_cci ?: 'N/A' }}</li>
    </ul>
    @endif

    @if($paymentMethod->type === 'card')
    <p><strong>Pago con tarjeta:</strong></p>
    @if($paymentMethod->gateway_url)
    <p>
        <a href="{{ $paymentMethod->gateway_url }}" style="display:inline-block;background:#0f766e;color:#fff;padding:10px 16px;text-decoration:none;border-radius:6px;">Ir a pasarela de pago</a>
    </p>
    @else
    <p>No hay enlace de pasarela configurado. Contáctanos para completar el pago.</p>
    @endif
    @endif

    <p>Puedes ingresar a tu panel para subir comprobante y dar seguimiento a tu solicitud.</p>
    <p>Gracias por confiar en AYW.</p>
</body>
</html>
