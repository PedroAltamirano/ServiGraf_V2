<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pedidos', function (Blueprint $table) {
      // Cpmposite id empresa_id + id
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas');
      $table->unsignedMediumInteger('numero');
      $table->unique(['empresa_id', 'numero']); //ver en migracion
      $table->unsignedInteger('usuario_id');
      $table->foreign('usuario_id')->references('cedula')->on('usuarios');
      $table->unsignedInteger('usuario_mod_id');
      $table->foreign('usuario_mod_id')->references('cedula')->on('usuarios');
      $table->unsignedInteger('usuario_cob_id')->nullable();
      $table->foreign('usuario_cob_id')->references('cedula')->on('usuarios');
      $table->foreignId('cliente_id')->on('clientes');
      $table->date('fecha_entrada');
      $table->date('fecha_salida');
      $table->date('fecha_cobro')->nullable();
      $table->boolean('prioridad')->default(0);
      $table->unsignedTinyInteger('estado'); //pendiente, pagado
      $table->unsignedDecimal('cotizado', 7, 2);
      $table->string('detalle', 256);
      $table->string('papel', 140)->nullable();
      $table->unsignedMediumInteger('cantidad')->default(0);
      $table->unsignedDecimal('corte_alto', 5, 2);
      $table->unsignedDecimal('corte_ancho', 5, 2);
      $table->unsignedInteger('numerado_inicio');
      $table->unsignedInteger('numerado_fin');
      $table->unsignedDecimal('total_material', 6, 2);
      $table->unsignedDecimal('total_pedido', 6, 2);
      $table->unsignedDecimal('abono', 6, 2);
      $table->unsignedDecimal('saldo', 6, 2);
      $table->string('notas', 255)->nullable();
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
    Schema::dropIfExists('pedidos');
  }
}
