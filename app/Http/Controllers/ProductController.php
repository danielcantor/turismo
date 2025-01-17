<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_type' => 'required|numeric',
            'product_price' => 'required|numeric|min:0',
            'days' => 'required|numeric|min:0',
            'nights' => 'required|numeric|min:0'
        ]);
    
        // Si la validación falla, devolvemos una respuesta JSON con los errores
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }
    
    
        $product = new Product();
    
        $product->product_name = $request->input('product_name');
        $product->product_description = $request->input('product_description');
        $product->product_type = $request->input('product_type');
        $product->product_price = $request->input('product_price');
        $product->days = $request->input('days');
        $product->nights = $request->input('nights');
        
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('images', 'public');
            $product->product_image = $imagePath;
        }
        if ($request->hasFile('product_slider')) {
            $imagePath = $request->file('product_slider')->store('images', 'public');
            $product->product_slider = $imagePath;
        }
        $product->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente',
            'product' => $product
        ]);
    }
    public function modificar()
    {
        return view('productos.modificar');
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
            'product_price' => 'required|numeric|min:0',
            'product_image' => 'image',
            'product_slider' => 'image'
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
    public function get(Request $request){
        $perPage = 10; // Número de productos por página
        $page = $request->input('page', 1);
        $products = Product::paginate($perPage, ['*'], 'page', $page);    
        return response()->json($products);
    }
   public function show_product($id)
   {
       $product = Product::find($id);
   
       if (!$product) {
           abort(404);
       }

       return view('productos.store_product', [
              'product' => $product
         ]);
   }
    public function obtenerProducto($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $product->product_image = $product->product_image ? Storage::url($product->product_image) : null;
        $product->product_slider = $product->product_slider ? Storage::url($product->product_slider) : null;

        return response()->json($product);
    }
    
    public function modificarProducto(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_type' => 'required|numeric',
            'product_price' => 'required|numeric|min:0',
            'days' => 'required|numeric|min:0',
            'nights' => 'required|numeric|min:0'
        ]);
    
        // Si la validación falla, devolvemos una respuesta JSON con los errores
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }
    
        $producto = Product::find($id);
    
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    
        if ($request->hasFile('product_image')) {
            Storage::delete("public/".$producto->product_image);
            $imagePath = $request->file('product_image')->store('images', 'public');
            $producto->product_image = $imagePath;
        }
    
        if ($request->hasFile('product_slider')) {
            Storage::delete("public/".$producto->product_slider);
            $imagePath = $request->file('product_slider')->store('images', 'public');
            $producto->product_slider = $imagePath;
        }
    
        $producto->product_name = $request->input('product_name');
        $producto->product_description = $request->input('product_description');
        $producto->product_type = $request->input('product_type');
        $producto->product_price = $request->input('product_price');
        $producto->days = $request->input('days');
        $producto->nights = $request->input('nights');
    
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
