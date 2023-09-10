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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric|min:0',
            'product_image' => 'image'
        ]);
    
        $product = new Product();
    
        $product->product_name = $validated['product_name'];
        $product->product_description = $validated['product_description'];
        $product->product_price = $validated['product_price'];
        $product->product_type = $request->input('product_type');
    
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('images', 'public');
            $product->product_image = $imagePath;
        }
    
        $product->save();
    
        return redirect()->route('productos.create')->with('success', 'Producto creado correctamente');
    }
    public function modificar()
    {
        $products = Product::all();

        return view('productos.modificar', compact('products'));
    }
    public function save(Request $request){

        $validated = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric|min:0'
        ]);

        $product = new Product();

        $product->product_name = $validated['product_name'];
        $product->product_description = $validated['product_description'];
        $product->product_price = $validated['product_price'];

        $product->save();

        return redirect()->route('productos.create')->with('success','Producto creado correctamente');
    }
    public function create()
    {
        return view('productos.create');
    }    
    public function edit(Request $request, $id)
    {   
        $validated = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric|min:0'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'product_price' => $validated['product_price']
        ]);
        
        return redirect()->route('productos.edit')->with('success','Producto editado correctamente');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
    public function activar(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $newStatus = $request->input('product_activate');
        $product->product_activate = $newStatus;
        $product->save();
        return response()->json(['message' => 'Estado del producto actualizado correctamente']);
    }
    public function show(){
        $products = Product::all();

        return view('productos.modificar', compact('products'));
    }
   // use App\Models\Product; // Asegúrate de importar el modelo de Producto adecuadamente

   public function show_product($id)
   {
       $product = Product::find($id);
   
       if (!$product) {
           abort(404);
       }
   
       return view('productos.store_product', compact('product'));
   }
   
    
}
