<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactEmprsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fact_empresa', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->string('empresa');
      $table->string('representante');
      $table->string('direccion');
      $table->string('ciudad');
      $table->string('correo');
      $table->string('telefono');
      $table->string('celular', 15)->nullable();
      $table->unsignedBigInteger('ruc');
      $table->date('valido_de');
      $table->date('valido_a');
      $table->text('clave_sri')->nullable();
      $table->text('clave_firma_sri')->nullable();
      $table->string('caja', 8);
      $table->unsignedMediumInteger('inicio');
      $table->foreignId('iva_id')->constrained('ivas')->onDelete('cascade');
      $table->foreignId('ret_iva_id')->constrained('retenciones')->onDelete('cascade');
      $table->foreignId('ret_fuente_id')->constrained('retenciones')->onDelete('cascade');
      $table->boolean('impresion');
      $table->string('logo')->nulable();
      $table->boolean('status');
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
    Schema::dropIfExists('fact_empresa');
  }
}
