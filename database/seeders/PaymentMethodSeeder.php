<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Tarjeta de Crédito/Débito',
                'code' => 'card',
                'type' => 'card',
                'instructions' => 'Usa la pasarela configurada o registra referencia de pago.',
                'is_active' => true,
            ],
            [
                'name' => 'Yape (QR)',
                'code' => 'yape',
                'type' => 'qr',
                'instructions' => 'Escanea el QR y registra el número de operación.',
                'is_active' => true,
            ],
            [
                'name' => 'Transferencia Bancaria',
                'code' => 'transfer',
                'type' => 'transfer',
                'instructions' => 'Realiza la transferencia y adjunta el voucher.',
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::updateOrCreate(['code' => $method['code']], $method);
        }
    }
}
