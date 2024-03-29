<?php

namespace App\Http\Controllers;

use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use App\Models\Product;
use App\Models\Passenger;
use App\Models\Shopping;
use App\Models\Facturacion;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function index(Request $request){
        $payment = $request->input('payment');

        if($payment == 'MercadoPago'){
            return $this->getMercadoPago($request);
        }else{
            return $this->getTransference($request);
        }
    }
    public function setPayload(Request $request){
        $product = Product::find($request->input('id'));
        $passengers = $request->input('pasajeros');
        $purchaseID = rand(1, 1000000) ;
        $shopping = new Shopping();
        $shopping->code = $purchaseID;
        $shopping->product_id = $product->id;
        $factura = $request->input('facturacion');
        $facturacion = new Facturacion();
        $columns = $facturacion->getFillable();
        foreach ($factura as $key => $value) {
            if(!in_array($key, $columns)) continue;
            $facturacion->$key = $value;
        }
        foreach ($passengers as $passenger) {
            
            $new = new Passenger();
            $new->purchase_id = $purchaseID;
            $new->nombre = $passenger['nombre'];
            $new->apellido = $passenger['apellido'];
            $new->nacimiento = $passenger['nacimiento'];
            $new->email = $passenger['email'];
            $new->nacionalidad = $passenger['nacionalidad'];
            $new->documento = $passenger['documento'];
            $new->celular = $passenger['celular'];
            $new->emergencia_nombre = $passenger['emergencia']['nombre'];
            $new->emergencia_apellido = $passenger['emergencia']['apellido'];
            $new->emergencia_celular = $passenger['emergencia']['celular'];
            $new->dieta_tipo = $passenger['dieta']['tipo'];
            $new->save();
        }
        $shopping->payment_status = 'pending';
        $shopping->payment_method = $request->input('payment');
        $shopping->total_price = (int) $request->input('price');
        $shopping->save();

        $facturacion->purchase_id = $shopping->id;
        $facturacion->save();
        return [
            'purchaseID' => $purchaseID,
            'product' => $product,
        ];
    }
    public function getMercadoPago( Request $request){
        SDK::setAccessToken('APP_USR-5080290645165804-102315-da0a88af09a1a2fe2d7a37c5497c3fb8-1050379468');
        //SDK::setAccessToken('TEST-7177899704829740-091014-c2e3f1f44f0a0395a6dd829ecb0effe1-1050379468');

        $preference = new Preference();
        $setup = $this->setPayload($request);
        $product = $setup['product'];
        $purchaseID = $setup['purchaseID'];
        // Crea un ítem en la preferencia
        $item = new Item();
        $item->title = "".$product->product_name."";
        $item->quantity = 1;
        $item->unit_price = (int) $request->input('price');
        $base_url = env('APP_URL');
        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => $base_url."/success/".$purchaseID."",
            "failure" => $base_url."/failure/".$purchaseID."",
            "pending" => $base_url."/pending/".$purchaseID.""
        );
        $preference->auto_return = "approved";
        $preference->save();

        return response()->json([
            'preference' => $preference->id
        ]);
    }
    public function getTransference(Request $request){
        $setup = $this->setPayload($request);
        $purchaseID = $setup['purchaseID'];
        
        return response()->json([
            'purchaseID' => $purchaseID
        ]);
    }
}
