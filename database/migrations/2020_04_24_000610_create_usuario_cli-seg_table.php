<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioCliSegTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('usuario_cli-seg', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('usuario_id');
      $table->foreign('usuario_id')->references('cedula')->on('usuarios');
      $table->foreignId('cliente_id')->on('clientes');
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
    Schema::dropIfExists('usuario_cli-seg');
  }
}
