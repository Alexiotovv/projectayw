<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $admin = Role::create(['name' => 'admin']);
        $customer = Role::create(['name' => 'customer']);
        
        // Crear permisos (si los necesitas)
        $permissions = [
            'view_dashboard',
            'manage_services',
            'view_payments',
            'update_profile',
        ];
        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $customer->givePermissionTo($permission);
        }
        
        // Dar todos los permisos al admin
        $admin->givePermissionTo(Permission::all());
    }
}