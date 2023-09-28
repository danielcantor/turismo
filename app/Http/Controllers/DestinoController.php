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
            'description' => 'El Turismo Nacional construye y preserva la identidad de cada destino, así como también pone en valor cada uno de sus Patrimonios. Te invitamos a recorrer juntos nuestro hermoso país.',
            'title' => 'Destinos',
            "subtitle" => "Nacionales",
            'imageUrl' => '/img/home/nacional.png'
        ]);
    }
    public function internacional(): View
    {
        $products = $this->product->getProductsbyType(2);

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Destinos Internacionales',
            'description' => 'Recorrer el mundo es una experiencia que requiere de un buen asesoramiento y recomendación para poder optimizar los tiempos y de esa forma concretar los deseos y expectativas de cada uno de ustedes. Los invitamos a conocer los circuitos internacionales junto a nosotros.',
            'title' => 'Destinos',
            "subtitle" => "Internacionales",
            'imageUrl' => '/img/home/internacional.png'
        ]);
    }
    public function aereo(): View
    {
        $products = $this->product->getProductsbyType(3);

        return view('turismo')->with([
            'items'=> $products,
            'pageName' => 'Destinos Aéreos',
            'description' => '',
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
            'description' => 'El miniturismo representa una porción sustancial de las economías de muchas regiones, ciudades o pueblos; con recorridos de pocos kilómetros, donde lo importante es siempre conectar con la identidad del lugar y regresar renovado.',
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
            'description' => '',
            'title' => 'Fin de',
            "subtitle" => "Semana",
            'imageUrl' => '/img/home/findelargo.jpg'
        ]);
    }
}
