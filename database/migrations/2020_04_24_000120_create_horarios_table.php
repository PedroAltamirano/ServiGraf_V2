<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('horarios', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas');
      $table->string('nombre', 30);
      $table->time('llegada_ma');
      $table->time('salida_ma');
      $table->time('llegada_ta');
      $table->time('salida_ta');
      $table->unsignedTinyInteger('espera');
      $table->unsignedTinyInteger('gracia');
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
    Schema::dropIfExists('horarios');
  }
}
