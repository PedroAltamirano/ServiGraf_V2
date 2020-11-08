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
        Schema::create('ot_tintas', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('pedido_id')->constrained('pedidos');
            $table->unsignedSmallInteger('tinta_id');
            $table->foreign('tinta_id')->references('id')->on('tintas');
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
        Schema::dropIfExists('ot_tintas');
    }
}
