<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        $permissions = [
            'view_dashboard',
            'view_certificados',
            'create_certificados',
            'edit_certificados',
            'delete_certificados',
            'view_users',
            'edit_users',
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'manage_services',
            'manage_service_plans',
            'manage_payment_methods',
            'view_payments',
            'view_contact_messages',
            'update_profile',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Roles
        $superadmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $admin      = Role::firstOrCreate(['name' => 'admin',      'guard_name' => 'web']);
        $customer   = Role::firstOrCreate(['name' => 'customer',   'guard_name' => 'web']);

        // Admin: todo excepto gestión de roles
        $adminPerms = Permission::whereNotIn('name', ['view_roles','create_roles','edit_roles','delete_roles'])->get();
        $admin->syncPermissions($adminPerms);

        // Customer: solo permisos propios
        $customer->syncPermissions(['view_dashboard', 'manage_services', 'view_payments', 'update_profile']);

        // Superadmin: todos
        $superadmin->syncPermissions(Permission::all());
    }
}
