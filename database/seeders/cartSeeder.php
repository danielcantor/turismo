<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $users = User::all();
        $products = Product::all();
        foreach ($users as $user) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $products->random()->id;
            $cart->ordered = false;
            $cart->quantity = rand(1, 10);
            $cart->save();
        }
    }
}
