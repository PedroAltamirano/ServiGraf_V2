<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBclientes')->create('contactos', function ($table) {
          $table->increments('id');
          $table->timestamps();
          $table->unsignedBigInteger('empresa_id');
          $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
          $table->unsignedInteger('usuario_id');
          $table->foreign('usuario_id')->references('cedula')->on('usuarios-v2.usuarios');
          $table->unsignedMediumInteger('cliente_empresa_id');
          $table->foreign('cliente_empresa_id')->references('id')->on('cliente_empresas');
          $table->string('actividad', 200);
          $table->string('titulo', 50);
          $table->string('nombre', 50);
          $table->string('apellido', 50);
          $table->string('cargo', 50);
          $table->string('direccion', 200);
          $table->string('sector', 50);
          $table->unsignedInteger('telefono');
          $table->unsignedInteger('celular');
          $table->unsignedMediumInteger('extencion');
          $table->string('email', 50);
          $table->string('web', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBclientes')->dropIfExists('contactos');
    }
}
