<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudMaterialsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('solicitud_materials', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
      $table->foreignId('material_id')->constrained('materiales')->onDelete('cascade');
      $table->unsignedMediumInteger('cantidad');
      $table->unsignedDecimal('corte_alto', 8, 2);
      $table->unsignedDecimal('corte_ancho', 8, 2);
      $table->unsignedMediumInteger('tamanos');
      $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade');
      $table->unsignedMediumInteger('factura')->nullable();
      $table->unsignedDecimal('total', 8, 2);
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
    Schema::dropIfExists('solicitud_materials');
  }
}
