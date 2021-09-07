<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCRMTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crm', function (Blueprint $table) {
      $table->id();
      $table->date('fecha');
      $table->time('hora');
      $table->foreignId('actividad');
      $table->unsignedInteger('creador_id');
      $table->foreign('creador_id')->references('cedula')->on('usuarios');
      $table->unsignedInteger('modificador_id')->nullable();
      $table->foreign('modificador_id')->references('cedula')->on('usuarios');
      $table->unsignedInteger('asignado_id');
      $table->foreign('asignado_id')->references('cedula')->on('usuarios');
      $table->foreignId('contacto_id')->nullable()->on('contactos');
      $table->boolean('estado')->default(1);
      $table->text('fuente')->nullable();
      $table->text('campania')->nullable();
      $table->text('nota')->nullable();
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
    Schema::dropIfExists('crm');
  }
}
