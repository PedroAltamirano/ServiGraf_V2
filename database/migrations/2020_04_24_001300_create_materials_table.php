<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('materiales', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('empresa_id');
      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
      $table->string('descripcion');
      $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
      $table->boolean('color');
      $table->unsignedDecimal('alto', 8, 2)->nullable();
      $table->unsignedDecimal('ancho', 8, 2)->nullable();
      $table->unsignedDecimal('precio', 5, 2)->nullable();
      $table->boolean('uv')->default(0);
      $table->boolean('plastificado')->default(0);
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
    Schema::dropIfExists('materiales');
  }
}
