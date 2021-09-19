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
      $table->string('actividad', 200)->nullable();
      $table->string('titulo', 50)->nullable();
      $table->string('nombre', 50);
      $table->string('apellido', 50);
      $table->string('cargo', 50)->nullable();
      $table->string('direccion', 200)->nullable();
      $table->string('sector', 50)->nullable();
      $table->unsignedInteger('telefono')->nullable();
      $table->unsignedInteger('celular');
      $table->unsignedMediumInteger('extencion')->nullable();
      $table->string('email', 50)->nullable();
      $table->string('web', 200)->nullable();
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
