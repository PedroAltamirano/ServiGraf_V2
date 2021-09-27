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
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedInteger('usuario_id_mod');
      $table->foreign('usuario_id_mod')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->string('nombre');
      $table->string('representante');
      $table->string('ruc', 14);
      $table->string('ciudad;
      $table->string('direccion;
      $table->string('telefono');
      $table->string('celular', 15);
      $table->string('web;
      $table->string('correo');
      $table->unsignedMediumInteger('inicio');
      // $table->unsignedTinyInteger('iva');
      $table->string('cloud->nullable();
      $table->string('mail->nullable();
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
    Schema::dropIfExists('datos_empresas');
  }
}
