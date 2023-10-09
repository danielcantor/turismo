<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
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

    private function responeseArray($status){
        return [
            'title' => $this->titles[$status],
            'message' => $this->response_messages[$status],
            'status' => $status
        ];
    }

    public function success() : View
    {
        return view('payment' , $this->responeseArray('approved'));
    }

    public function failure() : View
    {
        return view('payment' , $this->responeseArray('failure'));
    }

    public function pending() : View
    {
        return view('payment' , $this->responeseArray('pending'));
    }

}
