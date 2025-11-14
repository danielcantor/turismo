<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDepartureDateFromProductsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Removes the legacy departure_date column from products table.
     * This should be run AFTER migrating the data using MigrateDepartureDatesToNewTableSeeder.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('departure_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->date('departure_date')->nullable()->after('product_activate');
        });
    }
}
