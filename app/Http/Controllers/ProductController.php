<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
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

        return redirect()->view('productos.create')->with('success','Producto creado correctamente');
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
    public function eliminar($id)
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

   public function show_product($id)
   {
       $product = Product::find($id);
   
       if (!$product) {
           abort(404);
       }
       SDK::setAccessToken('TEST-7177899704829740-091014-c2e3f1f44f0a0395a6dd829ecb0effe1-1050379468');
    
       // Crea un objeto de preferencia
       $preference = new Preference();

       // Crea un ítem en la preferencia
       $item = new Item();
       $item->title = "".$product->product_name."";
       $item->quantity = 1;
       $item->unit_price = 1400;
       $preference->items = array($item);
       $preference->save();
       return view('productos.store_product', [
              'product' => $product,
              'preference' => $preference
         ]);
   }
   public function obtenerProducto($id){
        $producto = Product::find($id);

        if ($producto) {
            return response()->json($producto);
        } else {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    }
    
    public function modificarProducto(Request $request, $id){
        $this->validate($request, [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:1,2,3,4,5',
            'precio' => 'required|numeric',
        ]);

        $producto = Product::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $producto->product_name = $request->input('titulo');
        $producto->product_description = $request->input('descripcion');
        $producto->product_type = $request->input('tipo');
        $producto->product_price = $request->input('precio');

        $producto->save();

        return response()->json(['message' => 'Producto actualizado con éxito']);
    }

    public function activarDesactivarProducto($id){
        $producto = Product::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $producto->product_activate = $producto->product_activate == 1 ? 0 : 1;

        $producto->save();

        return response()->json(['message' => 'Estado del producto actualizado con éxito']);
    }

}
