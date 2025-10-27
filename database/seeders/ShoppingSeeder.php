<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoppingOrders = [
            [
                'user_id' => 1, // Juan Pérez
                'code' => 83792010,
                'product_id' => 1, // Tour Iguazú
                'total_price' => '15000',
                'payment_method' => 'Tarjeta de Crédito',
                'payment_status' => 'aprobado',
                'quantity' => 2,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'user_id' => 2, // María González
                'code' => 83792011,
                'product_id' => 2, // Bariloche
                'total_price' => '35000',
                'payment_method' => 'Transferencia Bancaria',
                'payment_status' => 'aprobado',
                'quantity' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 3, // Carlos Rodríguez
                'code' => 83792012,
                'product_id' => 3, // Brasil
                'total_price' => '150000',
                'payment_method' => 'Tarjeta de Crédito',
                'payment_status' => 'pendiente',
                'quantity' => 2,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 4, // Ana Martínez
                'code' => 83792013,
                'product_id' => 5, // Mendoza
                'total_price' => '28000',
                'payment_method' => 'Efectivo',
                'payment_status' => 'aprobado',
                'quantity' => 1,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ]
        ];

        DB::table('shopping')->insert($shoppingOrders);
    }
}