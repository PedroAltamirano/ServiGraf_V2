<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBproduccion')->create('pedido_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->unsignedDecimal('pedido_id', 18, 5);
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->unsignedMediumInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->unsignedMediumInteger('subservicio_id')->nullable();
            $table->foreign('subservicio_id')->references('id')->on('sub_servicios');
            $table->unsignedTinyInteger('tiro');
            $table->unsignedTinyInteger('retiro');
            $table->unsignedTinyInteger('millares');
            $table->unsignedDecimal('valor_unitario', 6, 2);
            $table->unsignedDecimal('total', 6, 2);
            $table->boolean('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBproduccion')->dropIfExists('pedido_servicios');
    }
}
