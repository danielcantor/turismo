<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purchases = [
            [
                'user_id' => 1, // Juan Pérez
                'purchase_code' => 1, // Referencia a shopping.id
                'total_price' => '15000',
                'payment_method' => 'Tarjeta de Crédito',
                'payment_status' => 'aprobado',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'user_id' => 2, // María González
                'purchase_code' => 2, // Referencia a shopping.id
                'total_price' => '35000',
                'payment_method' => 'Transferencia Bancaria',
                'payment_status' => 'aprobado',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 4, // Ana Martínez
                'purchase_code' => 4, // Referencia a shopping.id
                'total_price' => '28000',
                'payment_method' => 'Efectivo',
                'payment_status' => 'aprobado',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ]
        ];

        DB::table('purchases')->insert($purchases);
    }
}