<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('procesos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas');
      $table->foreignId('area_id')->references('id')->on('areas');
      $table->string('proceso', 140);
      $table->nestedSet();
      $table->unsignedDecimal('meta', 7, 2)->default(0.00);
      $table->time('tmaquina', 0)->nullable();
      $table->time('toperador', 0)->nullable();
      $table->boolean('tipo')->default(1); //interno o externo
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
    Schema::dropIfExists('procesos');
  }
}
