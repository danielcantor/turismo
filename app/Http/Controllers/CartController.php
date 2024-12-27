<?php

namespace App\Http\Controllers;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use App\Models\Product;
use App\Models\Passenger;
use App\Models\Shopping;
use App\Models\Facturacion;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function index(Request $request){

        return $this->getMercadoPago($request);

    }
    public function setPayload(Request $request){ 
        $product = Product::find($request->input('id'));
        $passengers = $request->input('pasajeros');
        $purchaseID = rand(1, 1000000);
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
        $shopping->total_price = (float) $request->input('price');
        $shopping->save();

        $facturacion->purchase_id = $shopping->id;
        $facturacion->save();
        return [
            'purchaseID' => $purchaseID,
            'product' => $product,
        ];
    }
    static function createPreferenceRequest($items, $payer , $purchaseID): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];
        $backUrls = [
            'success' => route('cart.success', ['purchaseID' => $purchaseID]),
            'failure' => route('cart.failure', ['purchaseID' => $purchaseID]),
            'pending' => route('cart.pending', ['purchaseID' => $purchaseID]),
        ];

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
            "external_reference" => "1234567890",
            "expires" => false,
            "auto_return" => 'approved',
        ];

        return $request;
    }
    public function getMercadoPago( Request $request){
        MercadoPagoConfig::setAccessToken("APP_USR-5080290645165804-102315-da0a88af09a1a2fe2d7a37c5497c3fb8-1050379468");
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
        //SDK::setAccessToken('TEST-7177899704829740-091014-c2e3f1f44f0a0395a6dd829ecb0effe1-1050379468');
        
        $product1 = array(
            "id" => "1234567890",
            "title" => "Product 1 Title",
            "description" => "Product 1 Description",
            "currency_id" => "BRL",
            "quantity" => 12,
            "unit_price" => 9.90
        );

        $product2 = array(
            "id" => "9012345678",
            "title" => "Product 2 Title",
            "description" => "Product 2 Description",
            "currency_id" => "BRL",
            "quantity" => 5,
            "unit_price" => 19.90
        );

        // Mount the array of products that will integrate the purchase amount
        $items = array($product1, $product2);

        // Retrieve information about the user (use your own function)
        $user = getSessionUser();

        $payer = array(
            "name" => $user->name,
            "surname" => $user->surname,
            "email" => $user->email,
        );

        // Create the request object to be sent to the API when the preference is created
        $request = createPreferenceRequest($item, $payer);

        // Instantiate a new Preference Client
        $client = new PreferenceClient();

        try {
            // Send the request that will create the new preference for user's checkout flow
            $preference = $client->create($request);

            // Useful props you could use from this object is 'init_point' (URL to Checkout Pro) or the 'id'
            return $preference;
        } catch (MPApiException $error) {
            // Here you might return whatever your app needs.
            // We are returning null here as an example.
            return null;
        }
}
