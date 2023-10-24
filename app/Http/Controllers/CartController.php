<?php

namespace App\Http\Controllers;

use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use App\Models\Product;
use App\Models\Passenger;
use App\Models\Purchase;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function getMercadoPago( Request $request){
        SDK::setAccessToken('APP_USR-5080290645165804-102315-da0a88af09a1a2fe2d7a37c5497c3fb8-1050379468');

        $preference = new Preference();
        $product = Product::find($request->input('id'));
        $passengers = $request->input('passengers');
        $purchaseID = rand(1, 1000) . time();
        $purchase = new Purchase();
        $purchase->purchase_code = $purchaseID;
        $purchase->product_id = $product->id;

        foreach ($passengers as $passenger) {
            $passenger = new Passenger();
            $passenger->purchase_id = $purchaseID;
            $passenger->nombre = $passenger['nombre'];
            $passenger->apellido = $passenger['apellido'];
            $passenger->nacimiento = $passenger['nacimiento'];
            $passenger->email = $passenger['email'];
            $passenger->nacionalidad = $passenger['nacionalidad'];
            $passenger->documento = $passenger['documento'];
            $passenger->celular = $passenger['celular'];
            $passenger->emergencia_nombre = $passenger['emergencia_nombre'];
            $passenger->emergencia_apellido = $passenger['emergencia_apellido'];
            $passenger->emergencia_celular = $passenger['emergencia_celular'];
            $passenger->dieta_tipo = $passenger['dieta_tipo'];
            $passenger->save();
        }
        $purchase->user_id = 0;
        $purchase->payment_status = 'pending';
        $purchase->payment_method = 'MercadoPago';
        $purchase->total_price = (int) $request->input('price');
        $purchase->save();
        // Crea un ítem en la preferencia
        $item = new Item();
        $item->title = "".$product->product_name."";
        $item->quantity = 1;
        $item->unit_price = (int) $request->input('price');
        $base_url = env('APP_URL');
        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => $base_url."/success?purchase_id=".$purchaseID."",
            "failure" => $base_url."/failure?purchase_id=".$purchaseID."",
            "pending" => $base_url."/pending?purchase_id=".$purchaseID.""
        );
        $preference->auto_return = "approved";
        $preference->save();

        return response()->json([
            'preference' => $preference->id
        ]);
    }
}
