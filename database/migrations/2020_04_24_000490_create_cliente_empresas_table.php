<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBclientes')->create('cliente_empresas', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('nombre');
            $table->bigInteger('ruc')->unique()->nullable($value = true);
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
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
        Schema::connection('DDBBclientes')->dropIfExists('cliente_empresas');
    }
}
