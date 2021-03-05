<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactEmprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fact_empresa', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->string('empresa', 50);
            $table->string('representante', 50);
            $table->unsignedBigInteger('ruc');
            $table->string('caja', 7);
            $table->unsignedMediumInteger('inicio');
            $table->date('valido_de');
            $table->date('valido_a');
            $table->unsignedSmallInteger('iva_id');
            $table->foreign('iva_id')->references('id')->on('ivas');
            $table->unsignedMediumInteger('ret_iva_id');
            $table->foreign('ret_iva_id')->references('id')->on('retenciones');
            $table->unsignedMediumInteger('ret_fuente_id');
            $table->foreign('ret_fuente_id')->references('id')->on('retenciones');
            $table->boolean('impresion');
            $table->string('logo');
            $table->boolean('status');
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
        Schema::dropIfExists('fact_empresa');
    }
}
