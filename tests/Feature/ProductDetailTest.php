<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductDetailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the product detail page loads successfully with a valid product.
     *
     * @return void
     */
    public function test_product_detail_page_loads_successfully()
    {
        // Create a test product
        $product = Product::create([
            'product_name' => 'Test Walking Tour',
            'product_price' => 15000,
            'product_description' => 'A beautiful walking tour through Argentina',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 3,
            'nights' => 2
        ]);

        // Visit the product detail page
        $response = $this->get("/productos/info/{$product->id}");

        // Assert the response is successful
        $response->assertStatus(200);
        
        // Assert the product name is present in the response
        $response->assertSee($product->product_name);
    }

    /**
     * Test that the product detail page returns 404 for non-existent product.
     *
     * @return void
     */
    public function test_product_detail_page_returns_404_for_nonexistent_product()
    {
        // Try to visit a product detail page with a non-existent ID
        $response = $this->get('/productos/info/99999');

        // Assert the response is 404
        $response->assertStatus(404);
    }

    /**
     * Test that the product detail page includes the Vue component.
     *
     * @return void
     */
    public function test_product_detail_page_includes_vue_component()
    {
        // Create a test product
        $product = Product::create([
            'product_name' => 'Test Tour Package',
            'product_price' => 20000,
            'product_description' => 'An amazing tour package',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 5,
            'nights' => 4
        ]);

        // Visit the product detail page
        $response = $this->get("/productos/info/{$product->id}");

        // Assert the Vue component is present
        $response->assertSee('product-detail-component');
    }
}
