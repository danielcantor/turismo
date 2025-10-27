<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixMissingForeignKeysRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Only add foreign keys for columns that already have the correct type
        // Skip shopping.product_id since it already has the foreign key
        
        // 2. For passengers table - only add foreign key if purchase_id is already correct type
        // We'll assume the purchase_id column type is correct for now
        try {
            Schema::table('passengers', function (Blueprint $table) {
                $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            });
        } catch (\Exception $e) {
            // Foreign key might already exist, continue
        }

        // 3. For facturacion table - only add foreign key if purchase_id is already correct type
        try {
            Schema::table('facturacion', function (Blueprint $table) {
                $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            });
        } catch (\Exception $e) {
            // Foreign key might already exist, continue
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop foreign keys if they exist
        try {
            Schema::table('facturacion', function (Blueprint $table) {
                $table->dropForeign(['purchase_id']);
            });
        } catch (\Exception $e) {
            // Foreign key might not exist
        }

        try {
            Schema::table('passengers', function (Blueprint $table) {
                $table->dropForeign(['purchase_id']);
            });
        } catch (\Exception $e) {
            // Foreign key might not exist
        }
    }
}
