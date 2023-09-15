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
            'title' => 'Destinos',
            "subtitle" => "Nacionales",
            'imageUrl' => '/img/home/Turismo-nacional-banner.jpg'
        ]);
    }
    public function internacional(): View
    {
        $products = Product::where('product_type', 2)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Destinos Internacionales',
            'title' => 'Destinos',
            "subtitle" => "Internacionales",
            'imageUrl' => '/img/home/Turismo-internacional-banner.jpg'
        ]);
    }
    public function aereo(): View
    {
        $products = Product::where('product_type', 3)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Destinos Aéreos',
            'title' => 'Pasajes',
            "subtitle" => "Aéreos",
            'imageUrl' => '/img/home/Turismo-aereo-banner.jpg'
        ]);
    }
    public function escapada(): View
    {
        $products = Product::where('product_type', 4)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Escapadas',
            'title' => '',
            "subtitle" => "Escapadas",
            'imageUrl' => '/img/home/Turismo-escapadas-banner.jpg'
        ]);
    }
    public function finde(): View
    {
        $products = Product::where('product_type', 5)->get();

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Fin de Semana',
            'title' => 'Fin de',
            "subtitle" => "Semana",
            'imageUrl' => '/img/home/Turismo-fin-de-semana-banner.jpg'
        ]);
    }
}
