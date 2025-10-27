<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ejecutar seeders en orden específico debido a las relaciones foreign key
        $this->call([
            CategorySeeder::class,    // Primero categorías (referenciadas por productos)
            ProductSeeder::class,     // Luego productos (referenciados por shopping)
            UserSeeder::class,        // Usuarios (referenciados por shopping y purchases)
            AdminSeeder::class,       // Administradores (tabla independiente)
            ShoppingSeeder::class,    // Shopping (referenciado por purchases)
            PurchaseSeeder::class,    // Purchases (referenciado por passengers y facturacion)
            PassengerSeeder::class,   // Pasajeros
            FacturacionSeeder::class, // Facturación
        ]);

        // Crear usuarios adicionales con factory
        User::factory(5)->create();

        // Finalmente agregar items al carrito (necesita que existan users y products)
        $this->call([
            cartSeeder::class,
        ]);
    }
}
