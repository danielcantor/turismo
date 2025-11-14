<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\DepartureDate;
use Illuminate\Support\Facades\DB;

class MigrateDepartureDatesToNewTableSeeder extends Seeder
{
    /**
     * Migrates legacy departure_date field from products to departure_dates table.
     * 
     * This seeder takes all products that have a non-null departure_date value
     * and creates corresponding records in the departure_dates table.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting migration of departure dates...');

        // Get all products that have a departure_date set
        $productsWithDates = Product::whereNotNull('departure_date')->get();

        if ($productsWithDates->isEmpty()) {
            $this->command->info('No products found with legacy departure_date field.');
            return;
        }

        $this->command->info("Found {$productsWithDates->count()} products with departure dates.");

        $migratedCount = 0;
        $skippedCount = 0;

        foreach ($productsWithDates as $product) {
            // Check if this product already has departure dates in the new table
            $existingDates = DepartureDate::where('product_id', $product->id)
                ->where('date', $product->departure_date)
                ->exists();

            if ($existingDates) {
                $this->command->warn("Product ID {$product->id} already has this date in new table. Skipping.");
                $skippedCount++;
                continue;
            }

            // Create new departure date record
            try {
                DepartureDate::create([
                    'product_id' => $product->id,
                    'date' => $product->departure_date,
                ]);
                
                $migratedCount++;
                $this->command->info("✓ Migrated product ID {$product->id}: {$product->product_name} - {$product->departure_date}");
            } catch (\Exception $e) {
                $this->command->error("✗ Failed to migrate product ID {$product->id}: {$e->getMessage()}");
            }
        }

        $this->command->info("Migration complete!");
        $this->command->info("Migrated: {$migratedCount} products");
        if ($skippedCount > 0) {
            $this->command->info("Skipped: {$skippedCount} products (already existed)");
        }
        $this->command->info("\nNext steps:");
        $this->command->warn("1. Verify the data in departure_dates table");
        $this->command->warn("2. Run the migration to remove the departure_date column: php artisan migrate");
    }
}
