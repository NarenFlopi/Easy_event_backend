<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedades', function (Blueprint $table) {
            $table->id();
            $table->text("descripcion");
            $table->foreignId('alquiler_id');
            $table->foreign('alquiler_id')->references('id')->on('alquilers');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('user_id')->on('alquilers');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novedades');
    }
}
