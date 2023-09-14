<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
class DestinoController extends Controller
{
    public function nacional(): View
    {
        $products = Product::where('product_type', 1)->get();

        return view('turismo')->with([
            'items' => $products,
            'pageName' => 'Destinos Nacionales',
            'imageUrl' => '/img/home/Turismo-nacional-banner.jpg'
        ]);
    }
    public function internacional(): View
    {
        $products = Product::where('product_type', 2)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Destinos Internacionales',
            'imageUrl' => '/img/home/Turismo-internacional-banner.jpg'
        ]);
    }
    public function aereo(): View
    {
        $products = Product::where('product_type', 3)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Destinos Aéreos',
            'imageUrl' => '/img/home/Turismo-aereo-banner.jpg'
        ]);
    }
    public function escapada(): View
    {
        $products = Product::where('product_type', 4)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Escapadas',
            'imageUrl' => '/img/home/Turismo-escapadas-banner.jpg'
        ]);
    }
    public function finde(): View
    {
        $products = Product::where('product_type', 5)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Fin de Semana',
            'imageUrl' => '/img/home/Turismo-fin-de-semana-banner.jpg'
        ]);
    }
}
