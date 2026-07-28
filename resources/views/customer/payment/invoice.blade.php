<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante {{ $payment->invoice_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 0; padding: 0; background: #f4f6fb; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; padding: 24px; }
        .card { background: #ffffff; border-radius: 12px; padding: 24px; border: 1px solid #e5e7eb; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header small { display: block; margin-top: 8px; color: #6b7280; }
        .section { margin-bottom: 24px; }
        .section-title { margin: 0 0 12px 0; font-size: 16px; color: #111827; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 10px 0; vertical-align: top; }
        .info-table td.label { width: 180px; color: #374151; font-weight: 700; }
        .badge { display: inline-block; padding: 6px 10px; border-radius: 9999px; background: #0f766e; color: #fff; font-size: 12px; }
        .footer { margin-top: 32px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div>
                    <h1>Comprobante de pago</h1>
                    <small>{{ now()->format('d/m/Y') }}</small>
                </div>
                <div class="badge">{{ $payment->status }}</div>
            </div>

            <div class="section">
                <h2 class="section-title">Información del pago</h2>
                <table class="info-table">
                    <tr>
                        <td class="label">Factura</td>
                        <td>{{ $payment->invoice_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Monto</td>
                        <td>S/. {{ number_format($payment->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Método</td>
                        <td>{{ strtoupper($payment->payment_method) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Fecha de pago</td>
                        <td>{{ $payment->payment_date?->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Vencimiento</td>
                        <td>{{ $payment->due_date?->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Referencia</td>
                        <td>{{ $payment->transaction_id ?: 'No registrada' }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Servicio</h2>
                <table class="info-table">
                    <tr>
                        <td class="label">Nombre</td>
                        <td>{{ $payment->service?->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Plan</td>
                        <td>{{ $payment->service?->plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Dominio</td>
                        <td>{{ $payment->service?->domain ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Descripción</td>
                        <td>Pago de servicio recurrente {{ $payment->service?->plan ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <div class="footer">
                <p>AYW Solution</p>
                <p>Gracias por tu pago. Este documento es un comprobante de tu transacción y puede ser descargado para tus registros.</p>
            </div>
        </div>
    </div>
</body>
</html>
