<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $products = Product::latest()->take(12)->get();
        return view('index', [
            'products' => $products
        ]);
    }
}
