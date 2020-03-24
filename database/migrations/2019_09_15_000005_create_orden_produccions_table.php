<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenProduccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBproduccion')->create('orden_produccion', function (Blueprint $table) {
            $table->timestamp('creacion');
            $table->string('empresa_id', 6);
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios-v2.usuarios');
            $table->unsignedInteger('usuario-mod_id');
            $table->foreign('usuario-mod_id')->references('cedula')->on('usuarios-v2.usuarios')->nullable();
            $table->unsignedInteger('usuario-cob_id');
            $table->foreign('usuario-cob_id')->references('cedula')->on('usuarios-v2.usuarios')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('ruc')->on('clientes-v2.clientes');
            $table->unsignedMediumInteger('numero')->primary();
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->boolean('prioridad')->default(0);
            $table->unsignedTinyInteger('estado');
            $table->date('fecha_cobro')->nullable();
            $table->string('detalle', 256);
            $table->string('papel', 140);
            $table->unsignedMediumInteger('cantidad')->default(0);
            $table->unsignedDecimal('corte_alto', 5, 2);
            $table->unsignedDecimal('corte_ancho', 5, 2);
            $table->unsignedInteger('numerado_inicio');
            $table->unsignedInteger('numerado_fin');
            $table->unsignedDecimal('total_pedidos', 6, 2);
            $table->unsignedDecimal('total_orden', 6, 2);
            $table->unsignedDecimal('abono', 6, 2);
            $table->unsignedDecimal('saldo', 6, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBproduccion')->dropIfExists('orden_produccion');
    }
}
