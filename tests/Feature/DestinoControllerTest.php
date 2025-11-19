<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\DepartureDate;

class DestinoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the destino page loads successfully with a valid category.
     *
     * @return void
     */
    public function test_destino_page_loads_successfully()
    {
        // Create a test category
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'A test category description',
            'image' => 'test-image.jpg',
            'subtitle' => 'Test subtitle'
        ]);

        // Create test products
        for ($i = 1; $i <= 15; $i++) {
            Product::create([
                'product_name' => "Test Product {$i}",
                'product_price' => 10000 + $i * 1000,
                'product_description' => "Description for product {$i}",
                'product_type' => $category->id,
                'product_category' => $category->id,
                'product_activate' => 1,
                'days' => 3,
                'nights' => 2
            ]);
        }

        // Visit the destino page
        $response = $this->get("/destinos/{$category->slug}");

        // Assert the response is successful
        $response->assertStatus(200);
        
        // Assert the category name is present in the response
        $response->assertSee($category->name);
    }

    /**
     * Test that pagination works correctly.
     *
     * @return void
     */
    public function test_pagination_works_correctly()
    {
        // Create a test category
        $category = Category::create([
            'name' => 'Pagination Test',
            'slug' => 'pagination-test',
            'description' => 'Testing pagination',
            'image' => 'test-image.jpg',
            'subtitle' => 'Test subtitle'
        ]);

        // Create 25 test products (should result in 3 pages with 12 per page)
        for ($i = 1; $i <= 25; $i++) {
            Product::create([
                'product_name' => "Product {$i}",
                'product_price' => 10000,
                'product_description' => "Description {$i}",
                'product_type' => $category->id,
                'product_category' => $category->id,
                'product_activate' => 1,
                'days' => 3,
                'nights' => 2
            ]);
        }

        // Visit first page
        $response = $this->get("/destinos/{$category->slug}");
        $response->assertStatus(200);
        
        // Visit second page
        $response = $this->get("/destinos/{$category->slug}?page=2");
        $response->assertStatus(200);
        
        // Visit third page
        $response = $this->get("/destinos/{$category->slug}?page=3");
        $response->assertStatus(200);
    }

    /**
     * Test that the destino page filters products by product_activate.
     *
     * @return void
     */
    public function test_destino_page_filters_inactive_products()
    {
        // Create a test category
        $category = Category::create([
            'name' => 'Filter Test',
            'slug' => 'filter-test',
            'description' => 'Testing filters',
            'image' => 'test-image.jpg',
            'subtitle' => 'Test subtitle'
        ]);

        // Create an active product
        $activeProduct = Product::create([
            'product_name' => 'Active Product',
            'product_price' => 10000,
            'product_description' => 'Active description',
            'product_type' => $category->id,
            'product_category' => $category->id,
            'product_activate' => 1,
            'days' => 3,
            'nights' => 2
        ]);

        // Create an inactive product
        $inactiveProduct = Product::create([
            'product_name' => 'Inactive Product',
            'product_price' => 20000,
            'product_description' => 'Inactive description',
            'product_type' => $category->id,
            'product_category' => $category->id,
            'product_activate' => 0,
            'days' => 5,
            'nights' => 4
        ]);

        // Visit the destino page
        $response = $this->get("/destinos/{$category->slug}");

        // Assert the response is successful
        $response->assertStatus(200);
        
        // Assert the active product is present
        $response->assertSee($activeProduct->product_name);
        
        // Assert the inactive product is not present
        $response->assertDontSee($inactiveProduct->product_name);
    }
}
