<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
class ShoppingController extends Controller
{
    
    public function index($id) : View
    {
        $products = new Product;
        $product = $products->getProduct($id);
        return view('checkout', [
            'product' => $product
        ]);
    }

    public function success() : View
    {
        return view('payment' , [
            'title' => '¡Gracias por tu compra!',
            'message' => 'Tu pago fue procesado exitosamente'
        ]);
    }
    
    public function failure() : View
    {
        return view('payment' , [
            'title' => '¡Hubo un problema con tu pago!',
            'message' => 'Tu pago no pudo ser procesado'
        ]);
    }


}
