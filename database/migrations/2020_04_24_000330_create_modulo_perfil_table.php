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
      $table->foreignId('perfil_id')->constrained('perfiles')->onDelete('cascade');
      $table->foreignId('modulo_id')->constrained('modulos')->onDelete('cascade');
      $table->foreignId('rol_id')->constrained('roles')->onDelete('cascade');
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
