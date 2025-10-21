<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DestinoController extends Controller
{
    // Route model binding por slug (Category::getRouteKeyName())
    public function show(Category $category): View
    {
        // Usar la relación y filtrar por product_activate para mantener comportamiento existente
        $products = $category->products()
            ->where('product_activate', 1)
            ->get();

        return view('turismo')->with([
            'items' => $products,
            'pageName' => $category->name,
            'description' => $category->description,
            'title' => $category->name,
            'subtitle' => $category->subtitle,
            'imageUrl' => Storage::url($category->image),
        ]);
    }
}