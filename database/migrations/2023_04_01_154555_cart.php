<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //make a products cart table
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('product_id')->unsigned()->index()->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->boolean('ordered')->default(false);
            $table->string('quantity');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        
        Schema::table('cart', function(Blueprint $table)
        {
            $table->dropForeign('cart_product_id_foreign');
            $table->dropForeign('cart_user_id_foreign');
        }); 
        
        Schema::dropIfExists('cart');
    }
}
