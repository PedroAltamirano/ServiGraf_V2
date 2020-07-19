<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBclientes')->create('clientes', function ($table) {
            $table->mediumIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas_v2.empresas');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios_v2.usuarios');
            $table->unsignedInteger('contacto_id');
            $table->foreign('contacto_id')->references('id')->on('contactos');
            $table->unsignedMediumInteger('cliente_empresa_id');
            $table->foreign('cliente_empresa_id')->references('id')->on('cliente_empresas');
            $table->boolean('seguimiento')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBclientes')->dropIfExists('clientes');
    }
}
