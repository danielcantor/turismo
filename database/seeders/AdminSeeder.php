<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Administrador Principal',
                'email' => 'admin@turismo.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@turismo.com',
                'password' => Hash::make('superadmin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente de Ventas',
                'email' => 'ventas@turismo.com',
                'password' => Hash::make('ventas123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Operador Turístico',
                'email' => 'operador@turismo.com',
                'password' => Hash::make('operador123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana García',
                'email' => 'ana.garcia@turismo.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('admins')->insert($admins);

        echo "✅ Creados " . count($admins) . " administradores de prueba:\n";
        foreach ($admins as $admin) {
            echo "   - {$admin['name']} ({$admin['email']})\n";
        }
        echo "\n";
    }
}