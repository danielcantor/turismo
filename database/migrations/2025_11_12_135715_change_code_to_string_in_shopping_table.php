<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodeToStringInShoppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping', function (Blueprint $table) {
            // Change code from bigInteger to string to support format like "000001-5"
            $table->string('code', 20)->nullable()->change();
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
            // Revert back to bigInteger
            $table->bigInteger('code')->unsigned()->nullable()->change();
        });
    }
}
