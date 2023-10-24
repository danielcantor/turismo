<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Passangers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->date('nacimiento');
            $table->string('email');
            $table->string('nacionalidad');
            $table->string('documento');
            $table->string('celular');
            $table->string('emergencia_nombre');
            $table->string('emergencia_apellido');
            $table->string('emergencia_celular');
            $table->string('dieta_tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
