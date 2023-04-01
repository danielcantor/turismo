<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Shopping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //make a shopping table
        Schema::create('shopping', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('code')->unsigned()->index()->nullable();
            $table->bigInteger('product_id')->unsigned()->index()->nullable();
            $table->string('total_price');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('code')->references('purchase_code')->on('cart')->onDelete('cascade');
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
        Schema::table('shopping', function(Blueprint $table)
        {
            $table->dropForeign('shopping_user_id_foreign');
            $table->dropForeign('shopping_purchase_code_foreign');
        });

        Schema::dropIfExists('shopping');
    }
}
