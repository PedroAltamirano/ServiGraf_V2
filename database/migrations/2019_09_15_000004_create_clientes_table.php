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
            $table->timestamp('creacion');
            $table->timestamp('modificacion');
            $table->string('empresa_id', 6);
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios-v2.usuarios');
            $table->string('empresa', 50);
            $table->unsignedBigInteger('ruc')->primary();
            $table->string('actividad', 140);
            $table->boolean('seguimiento')->default(0);
            $table->string('titulo', 50);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('cargo', 30);
            $table->string('direccion', 140);
            $table->string('sector', 50);
            $table->unsignedInteger('telefono');
            $table->unsignedInteger('celular');
            $table->unsignedMediumInteger('extencion');
            $table->string('email', 50);
            $table->string('web', 140);
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
