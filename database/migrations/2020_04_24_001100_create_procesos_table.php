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
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
      $table->string('proceso');
      $table->nestedSet();
      $table->unsignedDecimal('meta', 7, 2)->default(0.00);
      $table->time('tmaquina', 0)->nullable();
      $table->time('toperador', 0)->nullable();
      $table->boolean('tipo')->default(1)->comment('1: interno, 0: externo');
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
