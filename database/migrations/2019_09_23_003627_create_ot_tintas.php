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
            $table->unsignedMediumInteger('ot_id');
            $table->foreign('ot_id')->references('numero')->on('orden_produccion');
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
