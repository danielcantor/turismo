<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartureDateIdToShoppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping', function (Blueprint $table) {
            $table->unsignedBigInteger('departure_date_id')->nullable()->after('product_id');
            $table->foreign('departure_date_id')->references('id')->on('departure_dates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping', function (Blueprint $table) {
            $table->dropForeign(['departure_date_id']);
            $table->dropColumn('departure_date_id');
        });
    }
}
