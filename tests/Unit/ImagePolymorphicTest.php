<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;

class ImagePolymorphicTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a category can have multiple images
     *
     * @return void
     */
    public function test_category_can_have_images()
    {
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'Test description',
            'image' => 'test/main.jpg',
            'home_image' => 'test/home.jpg',
        ]);

        // Create images for the category
        $category->images()->create([
            'path' => 'test/main.jpg',
            'type' => 'main',
            'order' => 0
        ]);

        $category->images()->create([
            'path' => 'test/home.jpg',
            'type' => 'home',
            'order' => 1
        ]);

        $this->assertEquals(2, $category->images()->count());
    }

    /**
     * Test that a product can have multiple images
     *
     * @return void
     */
    public function test_product_can_have_images()
    {
        $product = new Product();
        $product->product_name = 'Test Product';
        $product->product_price = '1000';
        $product->product_description = 'Test description';
        $product->product_type = 1;
        $product->product_category = 1;
        $product->product_activate = 1;
        $product->days = 1;
        $product->nights = 0;
        $product->save();

        // Create images for the product
        $product->images()->create([
            'path' => 'test/main.jpg',
            'type' => 'main',
            'order' => 0
        ]);

        $product->images()->create([
            'path' => 'test/slider1.jpg',
            'type' => 'slider',
            'order' => 1
        ]);

        $product->images()->create([
            'path' => 'test/slider2.jpg',
            'type' => 'slider',
            'order' => 2
        ]);

        $this->assertEquals(3, $product->images()->count());
    }

    /**
     * Test that helper methods return correct images
     *
     * @return void
     */
    public function test_helper_methods_return_correct_images()
    {
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'Test description',
            'image' => 'test/main.jpg',
            'home_image' => 'test/home.jpg',
        ]);

        $category->images()->create([
            'path' => 'test/main.jpg',
            'type' => 'main',
            'order' => 0
        ]);

        $category->images()->create([
            'path' => 'test/home.jpg',
            'type' => 'home',
            'order' => 1
        ]);

        $mainImage = $category->getMainImage();
        $homeImage = $category->getHomeImage();

        $this->assertEquals('main', $mainImage->type);
        $this->assertEquals('test/main.jpg', $mainImage->path);
        $this->assertEquals('home', $homeImage->type);
        $this->assertEquals('test/home.jpg', $homeImage->path);
    }

    /**
     * Test that image URL attribute is generated correctly
     *
     * @return void
     */
    public function test_image_url_attribute()
    {
        $image = Image::create([
            'imageable_type' => Category::class,
            'imageable_id' => 1,
            'path' => 'test/image.jpg',
            'type' => 'main',
            'order' => 0
        ]);

        $this->assertEquals('/storage/test/image.jpg', $image->url);
    }
}
