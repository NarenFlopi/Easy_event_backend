<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->bigInteger('precio');
            $table->string('nombre_producto');
            $table->text('descripcion');
            $table->integer('cantidad_disponible');
            $table->integer('cantidad_inventario');
            $table->foreignId('empresa_id'); 
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreignId('categoria_id'); 
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string('foto')->nullable()->default('my_files/productos/no.png');
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
        Schema::dropIfExists('productos');
    }
}
