<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEmergenciaFieldsFromPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->dropColumn([
                'emergencia_nombre',
                'emergencia_apellido',
                'emergencia_celular'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->string('emergencia_nombre')->nullable();
            $table->string('emergencia_apellido')->nullable();
            $table->string('emergencia_celular')->nullable();
        });
    }
}
