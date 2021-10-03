<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('clientes', function ($table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->unsignedInteger('usuario_id');
      $table->foreign('usuario_id')->references('cedula')->on('usuarios')->onDelete('cascade');
      $table->foreignId('contacto_id')->constrained('contactos')->onDelete('cascade');
      $table->foreignId('cliente_empresa_id')->constrained('cliente_empresas')->onDelete('cascade');
      $table->boolean('seguimiento')->default(0);
      $table->unsignedTinyInteger('tipo_contribuyente');
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
    Schema::dropIfExists('clientes');
  }
}
