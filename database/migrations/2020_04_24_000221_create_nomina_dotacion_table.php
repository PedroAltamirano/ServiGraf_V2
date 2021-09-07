<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaDotacionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nomina_dotacion', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas');
      $table->unsignedInteger('nomina_id');
      $table->foreign('nomina_id')->references('cedula')->on('nomina');
      $table->date('entrega');
      $table->foreignId('dotacion_id')->constrained('dotacion');
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
    Schema::dropIfExists('nomina_dotacion');
  }
}
