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
        Schema::create('contactos', function ($table) {
          $table->id();
          $table->unsignedBigInteger('empresa_id');
          $table->foreign('empresa_id')->references('id')->on('empresas');
          $table->unsignedInteger('usuario_id');
          $table->foreign('usuario_id')->references('cedula')->on('usuarios');
          $table->unsignedMediumInteger('cliente_empresa_id');
          $table->foreign('cliente_empresa_id')->references('id')->on('cliente_empresas');
          $table->string('actividad', 200)->nullable();
          $table->string('titulo', 50)->nullable();
          $table->string('nombre', 50);
          $table->string('apellido', 50);
          $table->string('cargo', 50)->nullable();
          $table->string('direccion', 200)->nullable();
          $table->string('sector', 50)->nullable();
          $table->unsignedInteger('telefono')->nullable();
          $table->unsignedInteger('celular')->nullable();
          $table->unsignedMediumInteger('extencion')->nullable();
          $table->string('email', 50)->nullable();
          $table->string('web', 200)->nullable();
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
        Schema::dropIfExists('contactos');
    }
}
