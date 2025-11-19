<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Admin;

class ProductFilteringTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create an admin user for authentication
        $this->admin = Admin::factory()->create();
    }

    /**
     * Test filtering products by category
     */
    public function test_products_can_be_filtered_by_category()
    {
        // Create products with different categories
        Product::create([
            'product_name' => 'National Tour 1',
            'product_price' => 10000,
            'product_description' => 'A national tour',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 3,
            'nights' => 2
        ]);

        Product::create([
            'product_name' => 'International Tour 1',
            'product_price' => 20000,
            'product_description' => 'An international tour',
            'product_type' => 2,
            'product_category' => 2,
            'product_activate' => 1,
            'days' => 5,
            'nights' => 4
        ]);

        // Test filtering by category 1
        $response = $this->actingAs($this->admin, 'admin')
                         ->getJson('/products/get?category=1');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['product_name' => 'National Tour 1']);
    }

    /**
     * Test searching products by name
     */
    public function test_products_can_be_searched_by_name()
    {
        // Create test products
        Product::create([
            'product_name' => 'Beach Paradise Tour',
            'product_price' => 15000,
            'product_description' => 'A beach tour',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 4,
            'nights' => 3
        ]);

        Product::create([
            'product_name' => 'Mountain Adventure',
            'product_price' => 18000,
            'product_description' => 'A mountain tour',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 5,
            'nights' => 4
        ]);

        // Test searching for "Beach"
        $response = $this->actingAs($this->admin, 'admin')
                         ->getJson('/products/get?search=Beach');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['product_name' => 'Beach Paradise Tour']);
    }

    /**
     * Test sorting products by price
     */
    public function test_products_can_be_sorted_by_price()
    {
        // Create products with different prices
        Product::create([
            'product_name' => 'Expensive Tour',
            'product_price' => 50000,
            'product_description' => 'Expensive tour',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 7,
            'nights' => 6
        ]);

        Product::create([
            'product_name' => 'Cheap Tour',
            'product_price' => 10000,
            'product_description' => 'Cheap tour',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 2,
            'nights' => 1
        ]);

        // Test sorting by price ascending
        $response = $this->actingAs($this->admin, 'admin')
                         ->getJson('/products/get?sort_by=product_price&sort_order=asc');

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertEquals('Cheap Tour', $data[0]['product_name']);
        $this->assertEquals('Expensive Tour', $data[1]['product_name']);
    }

    /**
     * Test sorting products by name
     */
    public function test_products_can_be_sorted_by_name()
    {
        // Create products
        Product::create([
            'product_name' => 'Zebra Tour',
            'product_price' => 15000,
            'product_description' => 'Tour Z',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 3,
            'nights' => 2
        ]);

        Product::create([
            'product_name' => 'Alpha Tour',
            'product_price' => 15000,
            'product_description' => 'Tour A',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 3,
            'nights' => 2
        ]);

        // Test sorting by name ascending
        $response = $this->actingAs($this->admin, 'admin')
                         ->getJson('/products/get?sort_by=product_name&sort_order=asc');

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertEquals('Alpha Tour', $data[0]['product_name']);
        $this->assertEquals('Zebra Tour', $data[1]['product_name']);
    }

    /**
     * Test combining filters and search
     */
    public function test_products_can_be_filtered_and_searched_together()
    {
        // Create products
        Product::create([
            'product_name' => 'Beach Tour National',
            'product_price' => 15000,
            'product_description' => 'National beach tour',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 4,
            'nights' => 3
        ]);

        Product::create([
            'product_name' => 'Beach Tour International',
            'product_price' => 25000,
            'product_description' => 'International beach tour',
            'product_type' => 2,
            'product_category' => 2,
            'product_activate' => 1,
            'days' => 7,
            'nights' => 6
        ]);

        Product::create([
            'product_name' => 'Mountain Tour National',
            'product_price' => 18000,
            'product_description' => 'National mountain tour',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 5,
            'nights' => 4
        ]);

        // Test filtering by category 1 and searching for "Beach"
        $response = $this->actingAs($this->admin, 'admin')
                         ->getJson('/products/get?category=1&search=Beach');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['product_name' => 'Beach Tour National']);
    }
}
