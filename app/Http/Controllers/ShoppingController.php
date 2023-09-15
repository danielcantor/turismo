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
}
