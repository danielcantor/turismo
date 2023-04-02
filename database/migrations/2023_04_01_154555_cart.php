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
            $table->unsignedInteger('product_id')->unsigned()->index()->nullable();
            $table->unsignedInteger('user_id')->unsigned()->index()->nullable();
            $table->boolean('ordered')->default(false);
            $table->string('quantity');
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
        
        Schema::dropIfExists('cart');
    }
}
