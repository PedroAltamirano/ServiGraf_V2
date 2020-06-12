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
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->unsignedDecimal('pedido_id', 18, 5);
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->unsignedMediumInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materiales');
            $table->unsignedMediumInteger('cantidad');
            $table->unsignedDecimal('corte_alto', 5, 2);
            $table->unsignedDecimal('corte_ancho', 5, 2);
            $table->unsignedMediumInteger('tamanos');
            $table->unsignedSmallInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->unsignedMediumInteger('factura')->nullable();
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
