<?php

namespace App\Http\Controllers;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use App\Models\Product;
use App\Models\Passenger;
use App\Models\Shopping;
use App\Models\Facturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    public function index(Request $request){

        return $this->getMercadoPago($request);

    }

    public function reserve(Request $request){
        $product = Product::find($request->input('id'));
        $passengers = $request->input('pasajeros');
        
        // Wrap in transaction to ensure atomicity
        DB::beginTransaction();
        try {
            $shopping = new Shopping();
            $shopping->product_id = $product->id;
            $shopping->quantity = count($passengers);
            
            $factura = $request->input('facturacion');
            $facturacion = new Facturacion();
            $columns = $facturacion->getFillable();
            foreach ($factura as $key => $value) {
                if(!in_array($key, $columns)) continue;
                $facturacion->$key = $value;
            }
            
            $shopping->payment_status = 'reserved';
            $shopping->payment_method = 'Reserva';
            $shopping->total_price = (float) $request->input('price');
            $shopping->save();

            // Code is auto-generated in the model boot method with format 000001-ID
            $purchaseID = $shopping->code;
            
            foreach ($passengers as $passenger) {
                $new = new Passenger();
                $new->purchase_id = $shopping->id;
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

            $facturacion->purchase_id = $shopping->id;
            $facturacion->save();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to create reservation',
                'message' => $e->getMessage()
            ], 500);
        }
        
        // Send reservation confirmation email to customer and store
        \App\Jobs\SendPurchaseEmail::dispatch(
            $facturacion->nombre,
            $purchaseID,
            now()->format('d-m-Y'),
            $shopping->total_price,
            'reserved',
            $facturacion->email,
            [
                'billingName' => $facturacion->nombre . ' ' . $facturacion->apellido,
                'billingAddress' => $facturacion->direccion,
                'billingCity' => $facturacion->ciudad,
                'billingCountry' => $facturacion->pais,
                'productName' => $product->product_name,
                'productQuantity' => $shopping->quantity,
                'productPrice' => $product->product_price,
                'passengers' => $passengers
            ]
        )->onQueue('emails');
        
        return response()->json([
            'purchaseID' => $purchaseID,
            'status' => 'reserved'
        ]);
    }
    public function setPayload(Request $request){ 
        $product = Product::find($request->input('id'));
        $passengers = $request->input('pasajeros');
        
        // Wrap in transaction to ensure atomicity
        DB::beginTransaction();
        try {
            $shopping = new Shopping();
            $shopping->product_id = $product->id;
            $factura = $request->input('facturacion');
            $facturacion = new Facturacion();
            $columns = $facturacion->getFillable();
            foreach ($factura as $key => $value) {
                if(!in_array($key, $columns)) continue;
                $facturacion->$key = $value;
            }
            $shopping->payment_status = 'pending';
            $shopping->payment_method = $request->input('payment');
            $shopping->total_price = (float) $request->input('price');
            $shopping->save();

            // Code is auto-generated in the model boot method with format 000001-ID
            $purchaseID = $shopping->code;

            foreach ($passengers as $passenger) {
                
                $new = new Passenger();
                $new->purchase_id = $shopping->id;
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

            $facturacion->purchase_id = $shopping->id;
            $facturacion->save();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return [
            'purchaseID' => $purchaseID,
            'product' => $product,
        ];
    }
    static function createPreferenceRequest($items, $payer , $purchaseID): array
    {
        $paymentMethods = [
            "installments" => 12
        ];
        $backUrls = [
            'success' => route('cart.success', ['purchase_id' => $purchaseID]),
            'failure' => route('cart.failure', ['purchase_id' => $purchaseID]),
            'pending' => route('cart.pending', ['purchase_id' => $purchaseID]),
        ];

        $request = [
            "items" => [
                $items
            ],
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "Cynthia Garske Turismo",
            "external_reference" => $purchaseID,
            "expires" => false,
            "auto_return" => "approved",
        ];

        return $request;
    }
    public function getMercadoPago( Request $request){
        // Set your Mercado Pago access token
        $token = env("APP_ENV") == "local" ? env("MP_ACCESS_TOKEN_TEST") : env('MP_ACCESS_TOKEN');
        MercadoPagoConfig::setAccessToken($token);

        $prepare = $this->setPayload($request);
        $purchaseID = $prepare['purchaseID'];
        $product = $prepare['product'];

        $product_mp = array(
            "id" => $product->id,
            "title" => $product->product_name,
            "quantity" => 1,
            "unit_price" => (float)$request->input('price')
        );

        // Retrieve information about the user (use your own function)
        $user = $request->input('facturacion');

        $payer = array(
            "name" => $user['nombre'],
            "surname" => $user['apellido'],
            "email" => $user['email'],
        );

        // Create the request object to be sent to the API when the preference is created
        $request = $this->createPreferenceRequest($product_mp, $payer, $purchaseID);
        // Instantiate a new Preference Client
        
        $client = new PreferenceClient();

        try {
            // Send the request that will create the new preference for user's checkout flow
            $preference = $client->create($request);

            // Useful props you could use from this object is 'init_point' (URL to Checkout Pro) or the 'id'
            return response()->json([
                'init_point' => $preference->init_point,
                'preference' => $preference->id,
            ]);
        } catch (MPApiException $error) {
            // Here you might return whatever your app needs.
            // We are returning null here as an example.
            return response()->json([
                'error' => $error->getMessage(),
                "info" => $error->getCode(),
                "file" => $error->getFile(),
                "cause" => $error->getLine(), 
                'trace' => $error->getTraceAsString(),
                "data_send" => $request
            ]);
        }
    }
}
