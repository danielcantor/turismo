<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
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

    private function responeseArray($status , $purchaseID){
        return [
            'title' => $this->titles[$status],
            'message' => $this->response_messages[$status],
            'status' => $status
        ];
    }

    public function success(Request $request) : View
    {
        $purchaseID = $request->query('purchase_id');
        $purchase = Purchase::where("purchase_code", $purchaseID)->first();
        $purchase->payment_status = 'approved';
        return view('payment' , $this->responeseArray('approved' , $purchaseID));
    }

    public function failure(Request $request) : View
    {
        $purchaseID = $request->query('purchase_id');
        $purchase = Purchase::where("purchase_code", $purchaseID)->first();
        $purchase->payment_status = 'failure';
        return view('payment' , $this->responeseArray('failure' , $purchaseID));
    }

    public function pending(Request $request) : View
    {
        $purchaseID = $request->query('purchase_id');
        $purchase = Purchase::where("purchase_code", $purchaseID)->first();
        $purchase->payment_status = 'pending';
        return view('payment' , $this->responeseArray('pending' , $purchaseID));
    }

}
