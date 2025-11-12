<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReservationNumberToShoppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping', function (Blueprint $table) {
            // Add reservation_number column with auto-increment starting from 1
            $table->unsignedInteger('reservation_number')->nullable()->after('id');
        });
        
        // Set the AUTO_INCREMENT value to 1 for reservation_number
        // We'll handle this in the model instead for better control
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping', function (Blueprint $table) {
            $table->dropColumn('reservation_number');
        });
    }
}
