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
        Schema::connection('DDBBempresas')->create('datos_empresas', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas_v2.empresas');
            $table->unsignedInteger('usuario_id_mod');
            $table->foreign('usuario_id_mod')->references('cedula')->on('usuarios_v2.usuarios');
            $table->string('nombre', 50);
            $table->string('representante', 50);
            $table->string('ruc', 14);
            $table->string('direccion', 128);
            $table->unsignedInteger('telefono');
            $table->unsignedInteger('celular');
            $table->string('web', 128);
            $table->string('correo', 50);
            $table->unsignedMediumInteger('inicio');
            $table->unsignedTinyInteger('iva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBempresas')->dropIfExists('datos_empresas');
    }
}
