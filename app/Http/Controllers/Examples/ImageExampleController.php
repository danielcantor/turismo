<?php

/**
 * EXAMPLE USAGE OF POLYMORPHIC IMAGE SYSTEM
 * 
 * This file contains example code showing how to use the new polymorphic image system
 * in controllers. These examples can be integrated into existing controllers.
 */

namespace App\Http\Controllers\Examples;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageExampleController
{
    /**
     * Example: Create a category with images
     */
    public function createCategoryWithImages(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:category',
            'description' => 'required|string',
            'main_image' => 'required|image|max:2048',
            'home_image' => 'required|image|max:2048',
        ]);

        // Create the category
        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            // Old columns can be left for backwards compatibility
            'image' => 'placeholder.jpg',
            'home_image' => 'placeholder.jpg',
        ]);

        // Store main image using new system
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('categories', 'public');
            $category->images()->create([
                'path' => $path,
                'type' => 'main',
                'order' => 0
            ]);
        }

        // Store home image using new system
        if ($request->hasFile('home_image')) {
            $path = $request->file('home_image')->store('categories', 'public');
            $category->images()->create([
                'path' => $path,
                'type' => 'home',
                'order' => 1
            ]);
        }

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category->load('images')
        ], 201);
    }

    /**
     * Example: Get a category with its images for display
     */
    public function showCategoryWithImages($id)
    {
        $category = Category::with('images')->findOrFail($id);

        // Get specific images
        $mainImage = $category->getMainImage();
        $homeImage = $category->getHomeImage();

        return view('categories.show', [
            'category' => $category,
            'mainImageUrl' => $mainImage ? $mainImage->url : null,
            'homeImageUrl' => $homeImage ? $homeImage->url : null,
        ]);
    }

    /**
     * Example: Create a product with multiple slider images
     */
    public function createProductWithImages(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric',
            'main_image' => 'required|image|max:2048',
            'slider_images' => 'nullable|array',
            'slider_images.*' => 'image|max:2048',
        ]);

        // Create the product
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->product_type = $request->product_type ?? 1;
        $product->product_category = $request->product_category ?? 1;
        $product->product_activate = 1;
        $product->days = $request->days ?? 1;
        $product->nights = $request->nights ?? 0;
        $product->save();

        // Store main image
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            $product->images()->create([
                'path' => $path,
                'type' => 'main',
                'order' => 0
            ]);
        }

        // Store slider images
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $index => $image) {
                $path = $image->store('products/slider', 'public');
                $product->images()->create([
                    'path' => $path,
                    'type' => 'slider',
                    'order' => $index + 1
                ]);
            }
        }

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product->load('images')
        ], 201);
    }

    /**
     * Example: Update product images
     */
    public function updateProductImages(Request $request, $productId)
    {
        $request->validate([
            'main_image' => 'nullable|image|max:2048',
            'slider_images' => 'nullable|array',
            'slider_images.*' => 'image|max:2048',
        ]);

        $product = Product::findOrFail($productId);

        // Update main image if provided
        if ($request->hasFile('main_image')) {
            // Delete old main image
            $oldMainImage = $product->getMainImage();
            if ($oldMainImage) {
                Storage::disk('public')->delete($oldMainImage->path);
                $oldMainImage->delete();
            }

            // Store new main image
            $path = $request->file('main_image')->store('products', 'public');
            $product->images()->create([
                'path' => $path,
                'type' => 'main',
                'order' => 0
            ]);
        }

        // Update slider images if provided
        if ($request->hasFile('slider_images')) {
            // Delete old slider images
            $oldSliderImages = $product->getSliderImages();
            foreach ($oldSliderImages as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            // Store new slider images
            foreach ($request->file('slider_images') as $index => $image) {
                $path = $image->store('products/slider', 'public');
                $product->images()->create([
                    'path' => $path,
                    'type' => 'slider',
                    'order' => $index + 1
                ]);
            }
        }

        return response()->json([
            'message' => 'Product images updated successfully',
            'product' => $product->load('images')
        ]);
    }

    /**
     * Example: Get all products with their images for listing
     */
    public function listProductsWithImages()
    {
        // Eager load images for better performance
        $products = Product::with('images')->get();

        // Transform for API response
        $productsWithImages = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->product_name,
                'description' => $product->product_description,
                'price' => $product->product_price,
                'main_image' => $product->getMainImage()?->url,
                'slider_images' => $product->getSliderImages()->map(fn($img) => $img->url),
            ];
        });

        return response()->json($productsWithImages);
    }

    /**
     * Example: Delete image
     */
    public function deleteImage($imageId)
    {
        $image = \App\Models\Image::findOrFail($imageId);
        
        // Delete file from storage
        Storage::disk('public')->delete($image->path);
        
        // Delete database record
        $image->delete();

        return response()->json([
            'message' => 'Image deleted successfully'
        ]);
    }

    /**
     * Example: Reorder slider images
     */
    public function reorderSliderImages(Request $request, $productId)
    {
        $request->validate([
            'image_ids' => 'required|array',
            'image_ids.*' => 'required|integer|exists:images,id'
        ]);

        $product = Product::findOrFail($productId);

        // Update order for each image
        foreach ($request->image_ids as $index => $imageId) {
            $product->images()
                ->where('id', $imageId)
                ->where('type', 'slider')
                ->update(['order' => $index]);
        }

        return response()->json([
            'message' => 'Slider images reordered successfully',
            'images' => $product->getSliderImages()
        ]);
    }

    /**
     * Example: Get images for a model (generic)
     */
    public function getImagesForModel($modelType, $modelId)
    {
        // Get the model class
        $modelClass = match($modelType) {
            'category' => Category::class,
            'product' => Product::class,
            default => abort(400, 'Invalid model type')
        };

        // Find the model
        $model = $modelClass::findOrFail($modelId);

        // Return images
        return response()->json([
            'model_type' => $modelType,
            'model_id' => $modelId,
            'images' => $model->images->map(function($image) {
                return [
                    'id' => $image->id,
                    'url' => $image->url,
                    'type' => $image->type,
                    'order' => $image->order,
                ];
            })
        ]);
    }
}
