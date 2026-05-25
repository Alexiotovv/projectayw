<?php

namespace Database\Seeders;

use App\Models\ServicePlan;
use Illuminate\Database\Seeder;

class ServicePlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'VPS Start',
                'slug' => 'vps-start',
                'type' => 'vps',
                'description' => 'Servidor VPS para proyectos en crecimiento.',
                'price' => 79.90,
                'billing_cycle' => 'monthly',
                'features' => ['2 vCPU', '4 GB RAM', '80 GB SSD', 'Soporte técnico'],
                'is_active' => true,
            ],
            [
                'name' => 'Correo Business 20',
                'slug' => 'correo-business-20',
                'type' => 'email',
                'description' => 'Plan de correo corporativo para equipos medianos.',
                'price' => 49.90,
                'billing_cycle' => 'monthly',
                'features' => ['20 cuentas', '20 GB por cuenta', 'Panel administrador', 'Antispam'],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            ServicePlan::updateOrCreate(['slug' => $plan['slug']], $plan);
        }
    }
}
