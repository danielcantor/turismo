<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class cartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener productos y usuarios existentes para usar IDs válidos
        $products = Product::limit(5)->get();
        $users = User::limit(5)->get();

        if ($products->count() >= 3 && $users->count() >= 3) {
            $cartItems = [
                [
                    'product_id' => $products->get(2)->id, // Tercer producto
                    'user_id' => $users->get(2)->id, // Tercer usuario
                    'ordered' => false,
                    'quantity' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => $products->get(0)->id, // Primer producto
                    'user_id' => $users->get(4)->id ?? $users->get(0)->id, // Quinto usuario o primero
                    'ordered' => false,
                    'quantity' => '2',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => $products->get(1)->id, // Segundo producto
                    'user_id' => $users->get(0)->id, // Primer usuario
                    'ordered' => false,
                    'quantity' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            DB::table('cart')->insert($cartItems);
        }

        // Luego agregar items aleatorios para otros usuarios
        $additionalUsers = User::where('id', '>', 5)->get();
        $allProducts = Product::all();
        
        foreach ($additionalUsers as $user) {
            if ($allProducts->count() > 0) {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $allProducts->random()->id;
                $cart->ordered = false;
                $cart->quantity = rand(1, 3);
                $cart->save();
            }
        }
    }
}
