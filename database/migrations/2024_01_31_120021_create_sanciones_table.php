<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanciones', function (Blueprint $table) {
            $table->id();
            $table->string('motivo_reporte');
            $table->string('estado');
            $table->string('motivo_sancion')->nullable();
            $table->integer('duracion')->nullable();
            $table->foreignid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('usuario_reportado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanciones');
    }
}
