<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoProcesoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pedido_proceso', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas');
      $table->foreignId('pedido_id')->constrained('pedidos');
      $table->foreignId('proceso_id')->references('id')->on('procesos');
      $table->unsignedTinyInteger('tiro');
      $table->unsignedTinyInteger('retiro');
      $table->unsignedTinyInteger('millares');
      $table->unsignedDecimal('valor_unitario', 6, 2);
      $table->unsignedDecimal('total', 6, 2);
      $table->boolean('status')->default(0);
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
    Schema::dropIfExists('pedido_proceso');
  }
}
