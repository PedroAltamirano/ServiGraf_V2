<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtTintas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBproduccion')->create('ot_tintas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedDecimal('pedido_id', 18, 5);
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->unsignedSmallInteger('tinta_id');
            $table->foreign('tinta_id')->references('id')->on('tintas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBproduccion')->dropIfExists('ot_tintas');
    }
}
