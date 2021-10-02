<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('facturas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedInteger('usuario_id');
      $table->foreign('usuario_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->unsignedMediumInteger('numero');
      $table->foreignId('fact_emp_id')->constrained('fact_empresa')->onDelete('cascade');
      $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
      $table->date('emision');
      $table->date('vencimiento');
      $table->boolean('tipo')->comment('1: ingreso, 0: egreso');
      $table->unsignedTinyInteger('estado'); //pendiente pagado
      $table->date('fecha_pago')->nullable();
      $table->unsignedTinyInteger('tipo_pago');
      $table->unsignedDecimal('subtotal', 8, 2);
      $table->unsignedTinyInteger('descuento_p');
      $table->unsignedDecimal('descuento', 8, 2);
      $table->unsignedDecimal('iva', 8, 2);
      $table->unsignedDecimal('iva_0', 8, 2);
      $table->unsignedDecimal('total', 8, 2);
      $table->foreignId('ret_iva_p')->constrained('retenciones')->onDelete('cascade');
      $table->unsignedDecimal('ret_iva', 8, 2);
      $table->foreignId('ret_fuente_p')->constrained('retenciones')->onDelete('cascade');
      $table->unsignedDecimal('ret_fuente', 8, 2);
      $table->unsignedDecimal('total_pagar', 8, 2);
      $table->string('notas')->nullable();
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
    Schema::dropIfExists('facturas');
  }
}
