<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaEducTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nomina_educacion', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas');
      $table->unsignedInteger('nomina_id');
      $table->foreign('nomina_id')->references('cedula')->on('nomina');
      $table->unsignedTinyInteger('nivel_educ'); //1primaria, 2secu, 3superior, 4maestria, 5diplomado, 6idiomas, 7otros
      $table->string('nombre_institucion', 100);
      $table->date('inicio');
      $table->date('fin');
      $table->string('titulo');
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
    Schema::dropIfExists('nomina_educacion');
  }
}
