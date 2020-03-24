<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBproduccion')->create('orden_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('creacion');
            $table->unsignedMediumInteger('ot_id');
            $table->foreign('ot_id')->references('numero')->on('orden_produccion');
            $table->unsignedMediumInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->unsignedMediumInteger('subservicio_id');
            $table->foreign('subservicio_id')->references('id')->on('sub_servicios');
            $table->unsignedTinyInteger('tiro');
            $table->unsignedTinyInteger('retiro');
            $table->unsignedTinyInteger('millares');
            $table->unsignedDecimal('valor_unitario', 6, 2);
            $table->unsignedDecimal('total', 6, 2);
            $table->boolean('estado')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBproduccion')->dropIfExists('orden_servicios');
    }
}
