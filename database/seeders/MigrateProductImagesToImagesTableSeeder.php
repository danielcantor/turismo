<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class MigrateProductImagesToImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all products with their current images
        $products = Product::all();

        foreach ($products as $product) {
            // Migrate the main product image if it exists
            if (!empty($product->product_image)) {
                Image::create([
                    'imageable_type' => Product::class,
                    'imageable_id' => $product->id,
                    'path' => $product->product_image,
                    'type' => 'main',
                    'order' => 0
                ]);
            }

            // Migrate the slider image(s) if they exist
            if (!empty($product->product_slider)) {
                // Check if product_slider contains multiple images (comma-separated)
                $sliderImages = explode(',', $product->product_slider);
                
                foreach ($sliderImages as $index => $sliderImage) {
                    $sliderImage = trim($sliderImage);
                    if (!empty($sliderImage)) {
                        Image::create([
                            'imageable_type' => Product::class,
                            'imageable_id' => $product->id,
                            'path' => $sliderImage,
                            'type' => 'slider',
                            'order' => $index + 1
                        ]);
                    }
                }
            }
        }

        $this->command->info('Product images migrated successfully!');
    }
}
