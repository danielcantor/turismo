<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class DestinoController extends Controller
{
    // Route model binding por slug (Category::getRouteKeyName())
    public function show(Category $category): View
    {
        // Usar la relación y filtrar por product_activate para mantener comportamiento existente
        // Ordenar por fecha más cercana y paginar
        $today = now()->format('Y-m-d');
        $allProducts = $category->products()
            ->where('product_activate', 1)
            ->with(['departureDates' => function($query) use ($today) {
                $query->where('date', '>=', $today)
                      ->orderBy('date', 'asc');
            }])
            ->get()
            ->sortBy(function($product) use ($today) {
                $nextDate = $product->departureDates->first();
                // Products with future dates first, ordered by closest date
                if ($nextDate) {
                    return $nextDate->date;
                }
                // Products without future dates go to the end, ordered by created_at desc
                return '9999-99-99';
            })
            ->values(); // Reset collection keys after sorting

        // Manual pagination
        $perPage = 12;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allProducts->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $products = new LengthAwarePaginator(
            $currentItems,
            $allProducts->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

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