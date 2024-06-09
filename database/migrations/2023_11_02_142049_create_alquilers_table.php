<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateAlquilersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquilers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('metodo_pago')->nullable();
            $table->string('lugar_entrega')->nullable();
            $table->date('fecha_alquiler')->default(now());
            $table->date('fecha_devolucion')->nullable();
            $table->string('estado_pedido')->default('carrito');
            $table->string('estado_secuencia')->default('Inactivo');
            $table->bigInteger('precio_envio')->nullable();
            $table->bigInteger('costos_adicionales')->nullable();
            $table->bigInteger('precio_alquiler')->default(0);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alquilers');
    }
}
