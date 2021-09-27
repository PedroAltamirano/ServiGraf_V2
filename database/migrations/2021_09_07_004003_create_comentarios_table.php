<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('comentarios', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedInteger('creador_id');
      $table->foreign('creador_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->unsignedInteger('asignado_id');
      $table->foreign('asignado_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->foreignId('contacto_id')->nullable()->constrained('contactos')->onDelete('cascade');
      $table->text('comentario');
      $table->nestedSet();
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
    Schema::dropIfExists('comentarios');
  }
}
