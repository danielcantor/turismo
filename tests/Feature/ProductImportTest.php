<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Admin;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductImportTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create an admin user for authentication
        $this->admin = Admin::factory()->create();
    }

    /**
     * Test CSV import creates new products
     */
    public function test_csv_import_creates_new_products()
    {
        Storage::fake('local');

        // Create a CSV file content
        $csvContent = "product_name,product_price,product_description,product_type,product_category,days,nights,product_activate\n";
        $csvContent .= "\"Test Tour 1\",15000,\"A great tour\",1,1,3,2,1\n";
        $csvContent .= "\"Test Tour 2\",20000,\"Another great tour\",2,2,5,4,1\n";

        // Create a temporary file
        $file = UploadedFile::fake()->createWithContent('products.csv', $csvContent);

        $response = $this->actingAs($this->admin, 'admin')
                         ->post('/products/import', [
                             'file' => $file
                         ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $response->assertJsonStructure([
            'success',
            'message',
            'imported',
            'updated',
            'errors'
        ]);

        // Verify products were created
        $this->assertDatabaseHas('products', [
            'product_name' => 'Test Tour 1',
            'product_price' => '15000'
        ]);

        $this->assertDatabaseHas('products', [
            'product_name' => 'Test Tour 2',
            'product_price' => '20000'
        ]);

        $this->assertEquals(2, Product::count());
    }

    /**
     * Test CSV import updates existing products
     */
    public function test_csv_import_updates_existing_products()
    {
        Storage::fake('local');

        // Create an existing product
        $product = Product::create([
            'product_name' => 'Original Name',
            'product_price' => 10000,
            'product_description' => 'Original description',
            'product_type' => 1,
            'product_category' => 1,
            'product_activate' => 1,
            'days' => 3,
            'nights' => 2
        ]);

        // Create a CSV file with update
        $csvContent = "id,product_name,product_price,product_description,product_type,product_category,days,nights,product_activate\n";
        $csvContent .= "{$product->id},\"Updated Name\",25000,\"Updated description\",1,1,5,4,1\n";

        $file = UploadedFile::fake()->createWithContent('products.csv', $csvContent);

        $response = $this->actingAs($this->admin, 'admin')
                         ->post('/products/import', [
                             'file' => $file
                         ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Verify product was updated
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'product_name' => 'Updated Name',
            'product_price' => '25000'
        ]);

        // Ensure no new products were created
        $this->assertEquals(1, Product::count());
    }

    /**
     * Test CSV import validation rejects invalid file types
     */
    public function test_csv_import_rejects_invalid_file_types()
    {
        Storage::fake('local');

        // Create a non-CSV file
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->actingAs($this->admin, 'admin')
                         ->post('/products/import', [
                             'file' => $file
                         ]);

        $response->assertStatus(422);
        $response->assertJson(['success' => false]);
    }

    /**
     * Test CSV import requires authentication
     */
    public function test_csv_import_requires_authentication()
    {
        Storage::fake('local');

        $csvContent = "product_name,product_price,product_description,product_type,product_category,days,nights,product_activate\n";
        $csvContent .= "\"Test Tour\",15000,\"A great tour\",1,1,3,2,1\n";

        $file = UploadedFile::fake()->createWithContent('products.csv', $csvContent);

        $response = $this->post('/products/import', [
            'file' => $file
        ]);

        // Should redirect to login or return 401/403
        $this->assertTrue(in_array($response->status(), [302, 401, 403]));
    }

    /**
     * Test export template returns CSV file
     */
    public function test_export_template_returns_csv_file()
    {
        $response = $this->actingAs($this->admin, 'admin')
                         ->get('/products/export-template');

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $response->assertHeader('content-disposition', 'attachment; filename="plantilla_productos.csv"');
    }
}
