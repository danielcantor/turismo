<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //make a products table
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_price');
            $table->text('product_description');
            $table->integer('product_type');
            $table->string('product_image')->nullable();
            $table->string('product_slider')->nullable();
            $table->tinyInteger('product_activate')->default(1);
            $table->tinyInteger('days')->default(1);
            $table->tinyInteger('nights')->default(1);
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
        Schema::dropIfExists('products');
    }
}
