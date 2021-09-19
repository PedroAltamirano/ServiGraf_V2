<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibroMovimientosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('libro_movimientos', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('usuario_id');
      $table->foreign('usuario_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->foreignId('libro_id')->constrained('libros')->onDelete('cascade');
      $table->foreignId('libro_ref_id')->constrained('libro_refs')->onDelete('cascade');
      $table->date('fecha');
      $table->string('beneficiario', 50);
      $table->unsignedInteger('ci');
      $table->string('detalle', 140);
      $table->boolean('tipo')->comment('1:ingreso, 0:egreso');
      $table->unsignedDecimal('ingreso', 7, 2)->nullable();
      $table->unsignedDecimal('egreso', 7, 2)->nullable();
      $table->foreignId('banco_id')->constrained('bancos')->onDelete('cascade');
      $table->unsignedInteger('cuenta')->nullable();
      $table->unsignedInteger('cheque')->nullable();
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
    Schema::dropIfExists('libro_movimientos');
  }
}
