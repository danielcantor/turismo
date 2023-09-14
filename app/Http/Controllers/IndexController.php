<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class IndexController extends Controller
{
    public function index(){
        $products = Product::latest()->take(10)->get();
        return view('index', [
            'products' => $products
        ]);
    }
}
