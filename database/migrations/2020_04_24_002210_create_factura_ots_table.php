<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaOtsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('factura_ots', function (Blueprint $table) {
      $table->id();
      $table->foreignId('factura_id')->constrained('facturas')->onDelete('cascade');
      $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
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
    Schema::dropIfExists('factura_ots');
  }
}
