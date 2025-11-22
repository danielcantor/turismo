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
            'nights' => 'required|numeric|min:0',
            'departure_dates' => 'nullable|array',
            'departure_dates.*' => 'required|date'
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
        $product->product_category = $request->input('product_type'); // Also save as product_category for category relationship
        $product->product_price = $request->input('product_price');
        $product->days = $request->input('days');
        $product->nights = $request->input('nights');
        
        $product->save();

        // Store main image using polymorphic relationship
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
            $product->images()->create([
                'path' => $imagePath,
                'type' => 'main',
                'order' => 0
            ]);
        }

        // Store slider image(s) using polymorphic relationship
        if ($request->hasFile('product_slider')) {
            // Handle single file
            if (!is_array($request->file('product_slider'))) {
                $sliderPath = $request->file('product_slider')->store('products/slider', 'public');
                $product->images()->create([
                    'path' => $sliderPath,
                    'type' => 'slider',
                    'order' => 1
                ]);
            } else {
                // Handle multiple files
                foreach ($request->file('product_slider') as $index => $file) {
                    $sliderPath = $file->store('products/slider', 'public');
                    $product->images()->create([
                        'path' => $sliderPath,
                        'type' => 'slider',
                        'order' => $index + 1
                    ]);
                }
            }
        }
    
        // Handle multiple departure dates
        if ($request->has('departure_dates') && is_array($request->input('departure_dates'))) {
            foreach ($request->input('departure_dates') as $date) {
                \App\Models\DepartureDate::create([
                    'product_id' => $product->id,
                    'date' => $date
                ]);
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente',
            'product' => $product->load('images')
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
        
        // Build query
        $query = Product::query();
        
        // Filter by category
        if ($request->has('category') && $request->input('category') !== '') {
            $query->where('product_category', $request->input('category'));
        }
        
        // Search by product name
        if ($request->has('search') && $request->input('search') !== '') {
            $query->where('product_name', 'like', '%' . $request->input('search') . '%');
        }
        
        // Sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        
        // Validate sort fields
        $allowedSortFields = ['created_at', 'product_category', 'product_price', 'product_name'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $products = $query->paginate($perPage, ['*'], 'page', $page);    
        return response()->json($products);
    }
    public function show_product($id)
    {
        $product = Product::with('departureDates')->find($id);

        if (!$product) {
            abort(404);
        }

        // Return the new Vue.js based product detail view
        return view('productos.product_detail', [
            'product' => $product
        ]);
    }
    public function obtenerProducto($id)
    {
        $product = Product::with(['departureDates', 'images'])->find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Use polymorphic images if available, fallback to old columns
        $mainImage = $product->getMainImage();
        $sliderImages = $product->getSliderImages();

        $product->product_image = $mainImage ? $mainImage->url : ($product->product_image ? Storage::url($product->product_image) : null);
        $product->product_slider = $sliderImages->isNotEmpty() 
            ? $sliderImages->pluck('url')->toArray() 
            : ($product->product_slider ? Storage::url($product->product_slider) : null);

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
            'nights' => 'required|numeric|min:0',
            'departure_dates' => 'nullable|array',
            'departure_dates.*' => 'required|date'
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
    
        // Update main image if provided
        if ($request->hasFile('product_image')) {
            // Delete old main image
            $oldMainImage = $producto->getMainImage();
            if ($oldMainImage) {
                Storage::disk('public')->delete($oldMainImage->path);
                $oldMainImage->delete();
            }
            
            // Create new main image
            $imagePath = $request->file('product_image')->store('products', 'public');
            $producto->images()->create([
                'path' => $imagePath,
                'type' => 'main',
                'order' => 0
            ]);
        }
    
        // Update slider image(s) if provided
        if ($request->hasFile('product_slider')) {
            // Delete old slider images
            $oldSliderImages = $producto->getSliderImages();
            foreach ($oldSliderImages as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
            
            // Create new slider images
            if (!is_array($request->file('product_slider'))) {
                $sliderPath = $request->file('product_slider')->store('products/slider', 'public');
                $producto->images()->create([
                    'path' => $sliderPath,
                    'type' => 'slider',
                    'order' => 1
                ]);
            } else {
                foreach ($request->file('product_slider') as $index => $file) {
                    $sliderPath = $file->store('products/slider', 'public');
                    $producto->images()->create([
                        'path' => $sliderPath,
                        'type' => 'slider',
                        'order' => $index + 1
                    ]);
                }
            }
        }
    
        $producto->product_name = $request->input('product_name');
        $producto->product_description = $request->input('product_description');
        $producto->product_type = $request->input('product_type');
        $producto->product_category = $request->input('product_type'); // Also save as product_category for category relationship
        $producto->product_price = $request->input('product_price');
        $producto->days = $request->input('days');
        $producto->nights = $request->input('nights');
    
        $producto->save();
    
        // Handle multiple departure dates - delete old ones and create new ones
        if ($request->has('departure_dates')) {
            // Delete existing departure dates
            \App\Models\DepartureDate::where('product_id', $producto->id)->delete();
            
            // Create new departure dates
            if (is_array($request->input('departure_dates'))) {
                foreach ($request->input('departure_dates') as $date) {
                    \App\Models\DepartureDate::create([
                        'product_id' => $producto->id,
                        'date' => $date
                    ]);
                }
            }
        }
    
        return response()->json(['message' => 'Producto actualizado con éxito', 'product' => $producto->load('images')]);
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

    public function importProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $file = $request->file('file');
        $path = $file->getRealPath();
        
        $csv = array_map('str_getcsv', file($path));
        $header = array_shift($csv);
        
        $imported = 0;
        $updated = 0;
        $errors = [];

        foreach ($csv as $index => $row) {
            try {
                if (count($row) !== count($header)) {
                    $errors[] = "Fila " . ($index + 2) . ": número incorrecto de columnas";
                    continue;
                }
                
                $data = array_combine($header, $row);
                
                // Check if product exists (by name or ID if provided)
                $product = null;
                if (isset($data['id']) && !empty($data['id'])) {
                    $product = Product::find($data['id']);
                }
                
                $productData = [
                    'product_name' => $data['product_name'] ?? '',
                    'product_price' => $data['product_price'] ?? 0,
                    'product_description' => $data['product_description'] ?? '',
                    'product_type' => $data['product_type'] ?? 1,
                    'product_category' => $data['product_category'] ?? $data['product_type'] ?? 1,
                    'days' => $data['days'] ?? 1,
                    'nights' => $data['nights'] ?? 1,
                    'product_activate' => isset($data['product_activate']) ? $data['product_activate'] : 1
                ];

                if ($product) {
                    $product->update($productData);
                    $updated++;
                } else {
                    Product::create($productData);
                    $imported++;
                }
            } catch (\Exception $e) {
                $errors[] = "Fila " . ($index + 2) . ": " . $e->getMessage();
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Importación completada. Productos creados: {$imported}, actualizados: {$updated}",
            'imported' => $imported,
            'updated' => $updated,
            'errors' => $errors
        ]);
    }

    public function exportTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="plantilla_productos.csv"',
        ];

        $columns = ['id', 'product_name', 'product_price', 'product_description', 'product_type', 'product_category', 'days', 'nights', 'product_activate'];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
