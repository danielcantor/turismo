<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Facturacion;
use App\Models\Shopping;
use App\Mail\PaymentStatus;
use Illuminate\Support\Facades\Mail;

class ShoppingController extends Controller
{
    public $response_messages = [
        'pending' => 'Tu pago está pendiente',
        'approved' => 'Tu pago fue procesado exitosamente',
        'failure' => 'Tu pago no pudo ser procesado',
    ];
    public $titles = [
        'pending' => '¡Tu pago está pendiente!',
        'approved' => '¡Gracias por tu compra!',
        'failure' => '¡Hubo un problema con tu pago!',
    ];
    public function index($id) : View
    {
        $products = new Product;
        $product = $products->getProduct($id);
        
        return view('checkout', [
            'product' => $product
        ]);
    }

    private function responeseArray($status , $shopping){
        return [
            'title' => $this->titles[$status],
            'message' => $this->response_messages[$status],
            'status' => $status,
            'code' => $shopping->code
        ];
    }

    public function success($purchase, Request $request) : View
    {
        $payment_info = explode( "&" , $request->path() );

        foreach ($payment_info as $key => $value) {
            if($key != 0){
                 $payment_info[$key] = explode( "=" , $value );
            }else if($key == 0 || $key == end($payment_info) ){
                unset($payment_info[$key]);
            }
           
        }
        $facturacion = new Facturacion();
        
        $shopping = Shopping::where("code", $purchase)->first();
        
        if($shopping->purchases()->where("payment_status", 'approved')->count() > 0){
            return view('payment' , $this->responeseArray('approved' , $shopping));
        }

        $purchaseC = new Purchase();
        $columns = $purchaseC->getFillable();
        foreach ($payment_info as $value) {
            
            $column = $value[0];
            if(in_array($column, $columns)){
                $purchaseC->$column = $value[1];
            }
            
        }
        
        $shopping->payment_status = 'approved';

        $purchaseC->purchase_code = $shopping->id;

        $purchaseC->user_id = $shopping->user_id;
        $purchaseC->payment_status = 'approved';
        $purchaseC->payment_method = $shopping->payment_method;
        $purchaseC->total_price = $shopping->total_price;

        $shopping->save();
        $purchaseC->save();
        $mailing_info = $facturacion->where("purchase_id", $shopping->id)->first();

        // Enviar correo de pago exitoso
        Mail::to($mailing_info->email)->bcc('cynthiagarsketurismo@gmail.com')->send(new PaymentStatus(
            $mailing_info->nombre,
            $shopping->code,
            $shopping->created_at->format('d-m-Y'),
            $shopping->total_price,
            'success'
        ));
        
        return view('payment' , $this->responeseArray('approved' , $shopping));
    }

    public function failure($purchase, Request $request) : View
    {
        $shopping = Shopping::where("code", $purchase)->first();
        $shopping->payment_status = 'failure';
        $shopping->save();
        $facturacion = new Facturacion();
        $mailing_info = $facturacion->where("purchase_id", $shopping->id)->first();

        // Enviar correo de pago fallido
        Mail::to($mailing_info->email)->bcc('cynthiagarsketurismo@gmail.com')->send(new PaymentStatus(
            $mailing_info->nombre,
            $shopping->code,
            $shopping->created_at->format('d-m-Y'),
            $shopping->total_price,
            'failed'
        ));

        return view('payment' , $this->responeseArray('failure' , $shopping));
    }

    public function pending($purchase , Request $request) : View
    {
        $shopping = Shopping::where("code", $purchase)->first();
        $shopping->payment_status = 'pending';
        $shopping->save();
        $facturacion = new Facturacion();
        $mailing_info = $facturacion->where("purchase_id", $shopping->id)->first();

        // Enviar correo de pago pendiente
        Mail::to($mailing_info->email)->bcc('cynthiagarsketurismo@gmail.com')->send(new PaymentStatus(
            $mailing_info->nombre,
            $shopping->code,
            $shopping->created_at->format('d-m-Y'),
            $shopping->total_price,
            'pending'
        ));

        return view('payment' , $this->responeseArray('pending' , $shopping));
    }

}
