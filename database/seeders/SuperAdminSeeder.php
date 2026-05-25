<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar que el rol superadmin exista
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

        // Dar todos los permisos existentes al rol superadmin
        $superadminRole->syncPermissions(Permission::all());

        // Crear o actualizar el usuario superadmin para evitar credenciales desfasadas
        $user = User::updateOrCreate(
            ['email' => 'superadmin@aywsolution.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('SuperAdmin2026!'),
                'phone'    => null,
                'company'  => 'AYW Solution',
            ]
        );

        // Asignar rol superadmin
        if (! $user->hasRole('superadmin')) {
            $user->assignRole('superadmin');
        }
    }
}
