<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
class DestinoController extends Controller
{
    public $product;
    public $category;

    public function __construct()
    {
        $this->product = new Product;
        $this->category = new Category;
    }
    
    public function show($slug): View
    {
        $destino = $this->category->where('slug', $slug)->firstOrFail();
        $products = $this->product->getProductsbyType($destino->id);
        return view('turismo')->with([
            'items' => $products,
            'pageName' => $destino->name,
            'description' => $destino->description,
            'title' => $destino->name,
            'subtitle' => $destino->subtitle,
            'imageUrl' => Storage::url($destino->image)
        ]);
    }
}
