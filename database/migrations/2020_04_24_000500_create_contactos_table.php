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
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedInteger('usuario_id');
      $table->foreign('usuario_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->foreignId('cliente_empresa_id')->nullable()->constrained('cliente_empresas')->onDelete('cascade');
      $table->string('actividad')->nullable();
      $table->string('titulo')->nullable();
      $table->string('nombre');
      $table->string('apellido');
      $table->string('cargo')->nullable();
      $table->string('direccion->nullable();
      $table->string('sector')->nullable();
      $table->unsignedInteger('telefono')->nullable();
      $table->unsignedInteger('celular');
      $table->unsignedMediumInteger('extencion')->nullable();
      $table->string('email')->nullable();
      $table->string('web')->nullable();
      $table->timestamps();
      $table->softDeletes();
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
