<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('actividads', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('creador_id');
      $table->foreign('creador_id')->references('cedula')->on('usuarios');
      $table->unsignedInteger('modificador_id')->nullable();
      $table->foreign('modificador_id')->references('cedula')->on('usuarios');
      $table->string('nombre');
      $table->smallInteger('meta')->nullable();
      $table->foreignId('plantilla_id')->nullable();
      $table->boolean('evaluacion')->default(0);
      $table->boolean('seguimiento')->default(0);
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
    Schema::dropIfExists('actividads');
  }
}
