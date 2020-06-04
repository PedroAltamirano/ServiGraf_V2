<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBcontabilidad')->create('facturas', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios-v2.usuarios');
            $table->unsignedMediumInteger('numero')->unique();
            $table->unsignedMediumInteger('fact_emp_id');
            $table->foreign('fact_emp_id')->references('id')->on('fact_empresa');
            $table->unsignedMediumInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes-v2.clientes');
            $table->date('emision');
            $table->date('vencimiento');
            $table->unsignedTinyInteger('tipo');
            $table->unsignedTinyInteger('estado'); //pendiente pagado
            $table->unsignedTinyInteger('tipo_pago');
            $table->unsignedDecimal('subtotal', 8, 2);
            $table->unsignedTinyInteger('descuento_%');
            $table->unsignedDecimal('descuento', 8, 2);
            $table->unsignedDecimal('iva', 8, 2);
            $table->unsignedDecimal('iva_0', 8, 2);
            $table->unsignedDecimal('total', 8, 2);
            $table->unsignedMediumInteger('ret_iva_%');
            $table->foreign('ret_iva_%')->references('id')->on('retenciones');
            $table->unsignedDecimal('ret_iva', 8, 2);
            $table->unsignedMediumInteger('ret_fuente_%');
            $table->foreign('ret_fuente_%')->references('id')->on('retenciones');
            $table->unsignedDecimal('ret_fuente', 8, 2);
            $table->unsignedDecimal('total_pagar', 8, 2);
            $table->string('notas', 140);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBcontabilidad')->dropIfExists('facturas');
    }
}
