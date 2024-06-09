<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('empresas', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('nit_empresa');
        $table->string('direccion_empresa');
        $table->string('nombre_empresa');
        $table->bigInteger('telefono_empresa');
        $table->string('email_empresa');
        $table->string('estado');
        $table->foreignId('user_id'); 
        $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('empresas');
    }
}
