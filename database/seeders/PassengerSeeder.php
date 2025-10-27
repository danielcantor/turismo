<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $passengers = [
            // Pasajeros para Purchase ID 1 (Juan Pérez - Iguazú)
            [
                'purchase_id' => 1,
                'nombre' => 'Juan Carlos',
                'apellido' => 'Pérez González',
                'nacimiento' => '1985-03-15',
                'email' => 'juan.perez@test.com',
                'nacionalidad' => 'Argentina',
                'documento' => '12345678',
                'celular' => '11-1234-5678',
                'emergencia_nombre' => 'María Elena',
                'emergencia_apellido' => 'Pérez',
                'emergencia_celular' => '11-8765-4321',
                'dieta_tipo' => 0, // Normal
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'purchase_id' => 1,
                'nombre' => 'Sandra',
                'apellido' => 'López Pérez',
                'nacimiento' => '1987-07-22',
                'email' => 'sandra.lopez@test.com',
                'nacionalidad' => 'Argentina',
                'documento' => '23456789',
                'celular' => '11-2345-6789',
                'emergencia_nombre' => 'Carlos',
                'emergencia_apellido' => 'López',
                'emergencia_celular' => '11-9876-5432',
                'dieta_tipo' => 1, // Vegetariano
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            
            // Pasajeros para Purchase ID 2 (María González - Bariloche)
            [
                'purchase_id' => 2,
                'nombre' => 'María José',
                'apellido' => 'González Martín',
                'nacimiento' => '1992-11-08',
                'email' => 'maria.gonzalez@test.com',
                'nacionalidad' => 'Argentina',
                'documento' => '34567890',
                'celular' => '11-3456-7890',
                'emergencia_nombre' => 'Roberto',
                'emergencia_apellido' => 'González',
                'emergencia_celular' => '11-0987-6543',
                'dieta_tipo' => 2, // Celiaco
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            
            // Pasajeros para Purchase ID 3 (Ana Martínez - Mendoza)
            [
                'purchase_id' => 3,
                'nombre' => 'Ana Lucía',
                'apellido' => 'Martínez Vega',
                'nacimiento' => '1979-05-12',
                'email' => 'ana.martinez@test.com',
                'nacionalidad' => 'Argentina',
                'documento' => '45678901',
                'celular' => '11-4567-8901',
                'emergencia_nombre' => 'Miguel',
                'emergencia_apellido' => 'Martínez',
                'emergencia_celular' => '11-1098-7654',
                'dieta_tipo' => 3, // Diabético
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ]
        ];

        DB::table('passengers')->insert($passengers);
    }
}