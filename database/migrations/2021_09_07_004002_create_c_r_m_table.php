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
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->date('fecha');
      $table->time('hora');
      $table->foreignId('actividad_id')->constrained('actividades')->onDelete('cascade');
      $table->unsignedInteger('creador_id');
      $table->foreign('creador_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->unsignedInteger('modificador_id')->nullable();
      $table->foreign('modificador_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->unsignedInteger('asignado_id');
      $table->foreign('asignado_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->foreignId('contacto_id')->constrained('contactos')->onDelete('cascade');
      $table->boolean('estado')->default(0); // 1 terminado, 0 pendiente
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
