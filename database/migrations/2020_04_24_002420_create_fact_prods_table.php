<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactProdsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fact_prods', function (Blueprint $table) {
      $table->id();
      $table->foreignId('factura_id')->constrained('facturas')->onDelete('cascade');
      $table->unsignedSmallInteger('cantidad');
      $table->string('detalle');
      $table->foreignId('iva_id')->constrained('ivas')->onDelete('cascade');
      $table->decimal('valor_unitario', 9, 3)->unsigned();
      $table->decimal('subtotal', 9, 3)->unsigned();
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
    Schema::dropIfExists('fact_prods');
  }
}
