<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->query('type');

        if ($type == 'nacional') {
            $products = Product::where('product_type', 1)->get();
        } elseif ($type == 'internacional') {
            $products = Product::where('product_type', 2)->get();
        } else {
            $products = Product::all();
        }

        return view('productos.index')->with('products', $products);
    }
    public function create(): View
    {
        return view('productos.create');
    }
    public function save(Request $request){

        $validated = $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric|min:0'
        ]);

        $product = new Product();

        $product->product_title = $validated['product_title'];
        $product->product_description = $validated['product_description'];
        $product->product_price = $validated['product_price'];

        $product->save();

        return redirect()->route('productos.create')->with('success','Producto creado correctamente');
    }

    public function edit(Request $request, $id)
    {   
        $validated = $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric|min:0'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'product_title' => $validated['product_title'],
            'product_description' => $validated['product_description'],
            'product_price' => $validated['product_price']
        ]);
        
        return redirect()->route('productos.edit')->with('success','Producto editado correctamente');
    }
    public function delete(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('productos.edit')->with('success','Producto eliminado.');
    }
}
