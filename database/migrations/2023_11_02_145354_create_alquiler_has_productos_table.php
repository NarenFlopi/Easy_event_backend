<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlquilerHasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquiler_has_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alquiler_id');
            $table->foreign('alquiler_id')->references('id')->on('alquilers');
            $table->foreignId('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->bigInteger('cantidad_recibida')->nullable();
            $table->bigInteger('cantidad_devuelta')->nullable();
            $table->bigInteger('precio');
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alquiler_has_productos');
    }
}
