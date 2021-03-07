<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_empresas', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->unsignedInteger('usuario_id_mod');
            $table->foreign('usuario_id_mod')->references('cedula')->on('usuarios');
            $table->string('nombre', 50);
            $table->string('representante', 50);
            $table->string('ruc', 14);
            $table->string('ciudad', 250);
            $table->string('direccion', 250);
            $table->unsignedInteger('telefono');
            $table->unsignedInteger('celular');
            $table->string('web', 250);
            $table->string('correo', 50);
            $table->unsignedMediumInteger('inicio');
            // $table->unsignedTinyInteger('iva');
            $table->string('cloud', 250)->nullable();
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
        Schema::dropIfExists('datos_empresas');
    }
}
