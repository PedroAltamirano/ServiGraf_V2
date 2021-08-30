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
      $table->foreign('empresa_id')->references('id')->on('empresas');
      $table->string('empresa', 50);
      $table->string('representante', 50);
      $table->string('direccion');
      $table->string('correo');
      $table->string('telefono', 10);
      $table->string('celular', 15)->nullable();
      $table->unsignedBigInteger('ruc');
      $table->date('valido_de');
      $table->date('valido_a');
      $table->text('clave_sri')->nullable();
      $table->text('clave_firma_sri')->nullable();
      $table->string('caja', 7);
      $table->unsignedMediumInteger('inicio');
      $table->foreignId('iva_id')->on('ivas');
      $table->foreignId('ret_iva_id')->on('retenciones');
      $table->foreignId('ret_fuente_id')->on('retenciones');
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
