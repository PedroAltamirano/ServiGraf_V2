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
            $table->timestamps();
            $table->unsignedDecimal('pedidos_id', 18, 5);
            $table->foreign('pedidos_id')->references('id')->on('pedidos');
            $table->unsignedMediumInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materiales');
            $table->unsignedMediumInteger('cantidad');
            $table->unsignedDecimal('corte_alto', 5, 2);
            $table->unsignedDecimal('corte_ancho', 5, 2);
            $table->unsignedMediumInteger('tamanos');
            $table->unsignedSmallInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
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
