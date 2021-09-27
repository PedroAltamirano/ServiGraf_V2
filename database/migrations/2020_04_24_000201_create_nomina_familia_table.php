<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaFamiliaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nomina_familia', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedInteger('nomina_id');
      $table->foreign('nomina_id')->references('cedula')->on('nomina')->onDelete('cascade')->onDelete('cascade');
      $table->unsignedTinyInteger('relacion'); //1padre, 2madre, 3conyuge, 4hijo, 5otros
      $table->string('nombre_fam');
      $table->date('fecha_nacimiento_fam');
      $table->string('ocupacion')->nullable();
      $table->unsignedInteger('telefono_fam')->nullable();
      $table->unsignedInteger('celular_fam')->nullable();
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
    Schema::dropIfExists('nomina_familia');
  }
}
