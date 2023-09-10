<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
class DestinoController extends Controller
{
    public function nacional(): View
    {
        $products = Product::where('product_type', 1)->get();

        return view('turismo')->with([
            'items' => $products,
            'pageName' => 'Destinos Nacionales',
            'imageUrl' => 'asdasdsad'
        ]);
    }
    public function internacional(): View
    {
        $products = Product::where('product_type', 2)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Destinos Internacionales',
            'imageUrl' => 'asdasd'
        ]);
    }
}
