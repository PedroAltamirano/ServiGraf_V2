<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaReferTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nomina_refer', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedInteger('nomina_id');
      $table->foreign('nomina_id')->references('cedula')->on('nomina')->onDelete('cascade');
      $table->boolean('tipo_refer');
      $table->string('empresa')->nullable();
      $table->string('contacto');
      $table->unsignedInteger('telefono_refer');
      $table->string('afinidad');
      $table->date('inicio_labor_refer')->nullable();
      $table->date('fin_labor_refer')->nullable();
      $table->string('cargo_refer')->nullable();
      $table->string('razon_separacion')->nullable();
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
    Schema::dropIfExists('nomina_refer');
  }
}
