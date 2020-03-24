<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBproduccion')->create('solicitud_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('creacion');
            $table->unsignedMediumInteger('ot_id');
            $table->foreign('ot_id')->references('numero')->on('orden_produccion');
            $table->unsignedMediumInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materiales');
            $table->unsignedMediumInteger('cantidad');
            $table->unsignedDecimal('corte_alto', 5, 2);
            $table->unsignedDecimal('corte_ancho', 5, 2);
            $table->unsignedMediumInteger('tamanos');
            $table->unsignedSmallInteger('provedor_id');
            $table->foreign('provedor_id')->references('id')->on('provedores');
            $table->unsignedMediumInteger('factura');
            $table->unsignedDecimal('total', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBproduccion')->dropIfExists('solicitud_materials');
    }
}
