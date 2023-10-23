<?php

namespace App\Http\Controllers;

use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use App\Models\Product;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function getMercadoPago( Request $request){
        SDK::setAccessToken('APP_USR-5080290645165804-102315-da0a88af09a1a2fe2d7a37c5497c3fb8-1050379468');

        $preference = new Preference();
        $product = Product::find($request->input('id'));

        // Crea un ítem en la preferencia
        $item = new Item();
        $item->title = "".$product->product_name."";
        $item->quantity = 1;
        $item->unit_price = (int) $request->input('price');
        $base_url = env('APP_URL');
        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => $base_url."/success",
            "failure" => $base_url."/failure",
            "pending" => $base_url."/pending"
        );
        $preference->auto_return = "approved";
        $preference->save();

        return response()->json([
            'preference' => $preference->id
        ]);
    }
}
