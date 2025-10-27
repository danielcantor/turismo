<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacturacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facturaciones = [
            [
                'purchase_id' => 1, // Purchase de Juan Pérez
                'nombre' => 'Juan Carlos',
                'apellido' => 'Pérez González',
                'email' => 'juan.perez@test.com',
                'documento' => 12345678,
                'direccion' => 'Av. Corrientes 1234',
                'ciudad' => 'Buenos Aires',
                'provincia' => 'Buenos Aires',
                'codigo_postal' => 1001,
                'pais' => 'Argentina',
                'telefono' => '11-1234-5678',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'purchase_id' => 2, // Purchase de María González
                'nombre' => 'María José',
                'apellido' => 'González Martín',
                'email' => 'maria.gonzalez@test.com',
                'documento' => 23456789,
                'direccion' => 'Calle San Martín 567',
                'ciudad' => 'Córdoba',
                'provincia' => 'Córdoba',
                'codigo_postal' => 5000,
                'pais' => 'Argentina',
                'telefono' => '351-234-5678',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'purchase_id' => 3, // Purchase de Ana Martínez
                'nombre' => 'Ana Lucía',
                'apellido' => 'Martínez Vega',
                'email' => 'ana.martinez@test.com',
                'documento' => 34567890,
                'direccion' => 'Av. Belgrano 890',
                'ciudad' => 'Rosario',
                'provincia' => 'Santa Fe',
                'codigo_postal' => 2000,
                'pais' => 'Argentina',
                'telefono' => '341-345-6789',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ]
        ];

        DB::table('facturacion')->insert($facturaciones);
    }
}