<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoTintas extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pedido_tintas', function (Blueprint $table) {
      $table->id();
      $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
      $table->foreignId('tinta_id')->constrained('tintas')->onDelete('cascade');
      $table->boolean('lado');
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
    Schema::dropIfExists('pedido_tintas');
  }
}
