<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
class DestinoController extends Controller
{
    public $product;

    public function __construct()
    {
        $this->product = new Product;
    }
    public function nacional(): View
    {
        $products = $this->product->getProductsbyType(1);

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
        $products = $this->product->getProductsbyType(2);

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
        $products = $this->product->getProductsbyType(3);

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
        $products = $this->product->getProductsbyType(4);

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
        $products = $this->product->getProductsbyType(5);

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Fin de Semana',
            'title' => 'Fin de',
            "subtitle" => "Semana",
            'imageUrl' => '/img/home/Turismo-fin-de-semana-banner.jpg'
        ]);
    }
}
