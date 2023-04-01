<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Purchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //make a purchases table
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInterger('purchase_code')->unsigned()->index()->nullable();
            $table->string('total_price');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('purchase_code')->references('id')->on('shopping')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function(Blueprint $table)
        {
            $table->dropForeign('purchases_product_id_foreign');
            $table->dropForeign('purchases_user_id_foreign');
        });

        Schema::dropIfExists('purchases');
    
    }
}
