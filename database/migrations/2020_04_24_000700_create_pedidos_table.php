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
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedMediumInteger('numero');
      $table->unique(['empresa_id', 'numero']); //ver en migracion
      $table->unsignedInteger('usuario_id');
      $table->foreign('usuario_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->unsignedInteger('usuario_mod_id');
      $table->foreign('usuario_mod_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->unsignedInteger('usuario_cob_id')->nullable();
      $table->foreign('usuario_cob_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
      $table->date('fecha_entrada');
      $table->date('fecha_salida');
      $table->date('fecha_cobro')->nullable();
      $table->boolean('prioridad')->default(0);
      $table->unsignedTinyInteger('estado'); //1 pendiente, 2 pagado, 3 anulado, 4 canje
      $table->unsignedDecimal('cotizado', 7, 2);
      $table->string('detalle');
      $table->string('papel')->nullable();
      $table->unsignedMediumInteger('cantidad')->default(0);
      $table->unsignedDecimal('corte_alto', 8, 2);
      $table->unsignedDecimal('corte_ancho', 8, 2);
      $table->unsignedInteger('numerado_inicio');
      $table->unsignedInteger('numerado_fin');
      $table->unsignedDecimal('total_material', 6, 2);
      $table->unsignedDecimal('total_pedido', 6, 2);
      $table->unsignedDecimal('abono', 6, 2);
      $table->unsignedDecimal('saldo', 6, 2);
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
    Schema::dropIfExists('pedidos');
  }
}
