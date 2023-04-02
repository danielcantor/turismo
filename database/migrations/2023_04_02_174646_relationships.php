<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
        Schema::table('purchases', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('purchase_code')->references('id')->on('shopping')->onDelete('cascade');

        });
        Schema::table('cart', function (Blueprint $table) {

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('cart', function(Blueprint $table)
        {
            $table->dropForeign('cart_product_id_foreign');
            $table->dropForeign('cart_user_id_foreign');
        }); 

        Schema::table('purchases', function(Blueprint $table)
        {
            $table->dropForeign('purchases_product_id_foreign');
            $table->dropForeign('purchases_user_id_foreign');
        });

        Schema::table('shopping', function(Blueprint $table)
        {
            $table->dropForeign('shopping_user_id_foreign');
        });

    }
}
