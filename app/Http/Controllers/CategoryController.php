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
        $categories = Category::with('images')->get();

        foreach ($categories as $category) {
            // Use polymorphic images if available, fallback to old columns
            $mainImage = $category->getMainImage();
            $homeImage = $category->getHomeImage();
            
            $category->image = $mainImage ? $mainImage->url : ($category->image ? Storage::url($category->image) : null);
            $category->home_image = $homeImage ? $homeImage->url : ($category->home_image ? Storage::url($category->home_image) : null);
        }    
        return $categories;

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'home_image' => 'required|image',
        ]);

        // Create the category
        $category = new Category($request->except(['image', 'home_image']));
        $category->save();

        // Store main image using polymorphic relationship
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->images()->create([
                'path' => $imagePath,
                'type' => 'main',
                'order' => 0
            ]);
        }

        // Store home image using polymorphic relationship
        if ($request->hasFile('home_image')) {
            $homeImagePath = $request->file('home_image')->store('categories', 'public');
            $category->images()->create([
                'path' => $homeImagePath,
                'type' => 'home',
                'order' => 1
            ]);
        }

        return $category->load('images');
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);
    
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }
    
        // Update main image if provided
        if ($request->hasFile('image')) {
            // Delete old main image
            $oldMainImage = $category->getMainImage();
            if ($oldMainImage) {
                Storage::disk('public')->delete($oldMainImage->path);
                $oldMainImage->delete();
            }
            
            // Create new main image
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->images()->create([
                'path' => $imagePath,
                'type' => 'main',
                'order' => 0
            ]);
        }

        // Update home image if provided
        if ($request->hasFile('home_image')) {
            // Delete old home image
            $oldHomeImage = $category->getHomeImage();
            if ($oldHomeImage) {
                Storage::disk('public')->delete($oldHomeImage->path);
                $oldHomeImage->delete();
            }
            
            // Create new home image
            $homeImagePath = $request->file('home_image')->store('categories', 'public');
            $category->images()->create([
                'path' => $homeImagePath,
                'type' => 'home',
                'order' => 1
            ]);
        }

        $category->update($request->except(['image', 'home_image']));
        return $category->load('images');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}