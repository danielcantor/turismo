<?php
// app/Http/Controllers/CategoryController.php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index()
    {
        return view('categories');
    }

    public function getCategories()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $category->image = $category->image ? Storage::url($category->image) : null;
            $category->home_image = $category->home_image ? Storage::url($category->home_image) : null;
        }    
        return $categories;

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'subtitle' => 'nullable|string'  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }

        $category = new Category($request->all());    

        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('home_image')) {
            $category->home_image = $request->file('home_image')->store('images', 'public');
        }
        $category->save();

        return $category;
    }

    public function show(Category $category)
    {
        $category->image = $category->image ? Storage::url($category->image) : null;
        $category->home_image = $category->home_image ? Storage::url($category->home_image) : null;
        
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'subtitle' => 'nullable|string'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }
    
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($category->image);
            $category->image = $request->file('image')->store('images', 'public');
        }
    
        if ($request->hasFile('home_image')) {
            Storage::disk('public')->delete($category->home_image);
            $category->home_image = $request->file('home_image')->store('images', 'public');
        }
    
        $category->update($request->except(['image', 'home_image']));
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}