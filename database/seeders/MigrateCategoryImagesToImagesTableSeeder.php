<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class MigrateCategoryImagesToImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all categories with their current images
        $categories = Category::all();

        foreach ($categories as $category) {
            // Migrate the main image if it exists
            if (!empty($category->image)) {
                Image::create([
                    'imageable_type' => Category::class,
                    'imageable_id' => $category->id,
                    'path' => $category->image,
                    'type' => 'main',
                    'order' => 0
                ]);
            }

            // Migrate the home image if it exists
            if (!empty($category->home_image)) {
                Image::create([
                    'imageable_type' => Category::class,
                    'imageable_id' => $category->id,
                    'path' => $category->home_image,
                    'type' => 'home',
                    'order' => 1
                ]);
            }
        }

        $this->command->info('Category images migrated successfully!');
    }
}
