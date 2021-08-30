<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuloPerfilTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('modulo_perfil', function (Blueprint $table) {
      $table->id();
      $table->foreignId('perfil_id')->on('perfiles');
      $table->foreignId('modulo_id')->on('modulos');
      $table->foreignId('rol_id')->on('roles');
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
    Schema::dropIfExists('modulo_perfil');
  }
}
