<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Usuario Administrador Principal
        User::create([
            'name' => 'Alex Vásquez',
            'email' => 'avasquez@aywsolution.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#$%&GfdMA6sljs'),
            'is_admin' => true,
            'company' => 'AYW Solution',
            'phone' => '+51 980 534 198',
            'is_customer' => false,
            'remember_token' => Str::random(10),
        ]);

        // Usuario Admin Secundario
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@aywsolution.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#$42344NMSSa_34A%&/'),
            'is_admin' => true,
            'company' => 'AYW Solution',
            'phone' => '+51 999 888 777',
            'is_customer' => false,
            'remember_token' => Str::random(10),
        ]);

        // Cliente Ejemplo 1
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan.perez@empresa.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#$%&/!"$LkjmsMas'),
            'is_admin' => false,
            'company' => 'Tech Solutions SAC',
            'phone' => '+51 987 654 321',
            'is_customer' => true,
            'remember_token' => Str::random(10),
        ]);

        // Cliente Ejemplo 2
        User::create([
            'name' => 'María García',
            'email' => 'maria.garcia@negocio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('/&()#=AMmsnns0922'),
            'is_admin' => false,
            'company' => 'Digital Marketing EIRL',
            'phone' => '+51 976 543 210',
            'is_customer' => true,
            'remember_token' => Str::random(10),
        ]);

        // Usuario Regular (no admin, no customer)
        User::create([
            'name' => 'Carlos López',
            'email' => 'carlos.lopez@correo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#$%!#&/()==MAkjsmd'),
            'is_admin' => false,
            'company' => null,
            'phone' => '+51 965 432 109',
            'is_customer' => false,
            'remember_token' => Str::random(10),
        ]);

        // Más clientes para pruebas
        User::create([
            'name' => 'Roberto Mendoza',
            'email' => 'roberto.mendoza@servicios.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#$%&/()=MAjhshiA'),
            'is_admin' => false,
            'company' => 'Servicios Integrales SRL',
            'phone' => '+51 954 321 098',
            'is_customer' => true,
            'remember_token' => Str::random(10),
        ]);

        // Usuario de demostración
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@aywsolution.com',
            'email_verified_at' => now(),
            'password' => Hash::make('AMksji#"!$%&/()Sh'),
            'is_admin' => false,
            'company' => 'Demo Company',
            'phone' => '+51 943 210 987',
            'is_customer' => true,
            'remember_token' => Str::random(10),
        ]);

        // Generar usuarios adicionales aleatorios (opcional)
        $this->createRandomUsers(5);
    }

    /**
     * Crear usuarios aleatorios para pruebas
     */
    private function createRandomUsers($count = 5)
    {
        $companies = [
            'TechCorp SAC',
            'Innovatech EIRL',
            'WebSolutions',
            'Digital Agency',
            'Software Development',
            'Consulting Group',
            'Marketing Pro',
            'Cloud Services'
        ];

        $firstNames = ['Luis', 'Ana', 'Pedro', 'Lucía', 'Miguel', 'Sofía', 'Jorge', 'Carmen', 'Ricardo', 'Patricia'];
        $lastNames = ['Rodríguez', 'Fernández', 'González', 'Silva', 'Torres', 'Vargas', 'Ramírez', 'Flores', 'Rojas', 'Medina'];

        for ($i = 0; $i < $count; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $name = $firstName . ' ' . $lastName;
            $email = strtolower($firstName . '.' . $lastName . rand(1, 99) . '@example.com');
            
            User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => rand(0, 1) ? now() : null,
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'company' => rand(0, 1) ? $companies[array_rand($companies)] : null,
                'phone' => '+51 9' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                'is_customer' => (bool)rand(0, 1),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}