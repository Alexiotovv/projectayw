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

    <p>Puedes ingresar a tu panel para subir comprobante y dar seguimiento a tu solicitud.</p>
    <p>Gracias por confiar en AYW.</p>
</body>
</html>
