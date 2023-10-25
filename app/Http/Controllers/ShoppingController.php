<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Shopping;
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
        $purchaseC = new Purchase();
        $columns = $purchaseC->getFillable();
        foreach ($payment_info as $value) {
            
            $column = $value[0];
            if(in_array($column, $columns)){
                $purchaseC->$column = $value[1];
            }
            
        }
        $shopping = Shopping::where("code", $purchase)->first();
        $shopping->payment_status = 'approved';

        $purchaseC->purchase_code = $shopping->id;

        $purchaseC->user_id = $shopping->user_id;
        $purchaseC->payment_status = 'approved';
        $purchaseC->payment_method = $shopping->payment_method;
        $purchaseC->total_price = $shopping->total_price;

        $shopping->save();
        $purchaseC->save();
        return view('payment' , $this->responeseArray('approved' , $shopping));
    }

    public function failure($purchase, Request $request) : View
    {
        $purchaseID = $request->query('purchase_id');
        $shopping = Shopping::where("purchase_code", $purchaseID)->first();
        $shopping->payment_status = 'failure';
        $shopping->save();
        return view('payment' , $this->responeseArray('failure' , $shopping));
    }

    public function pending($purchase , Request $request) : View
    {
        $shopping = Shopping::where("purchase_code", $purchase)->first();
        $shopping->payment_status = 'pending';
        $shopping->save();
        return view('payment' , $this->responeseArray('pending' , $shopping));
    }

}
