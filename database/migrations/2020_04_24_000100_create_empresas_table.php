<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('empresas', function (Blueprint $table) {
      $table->bigIncrements('id'); //ruc
      $table->string('nombre', 30);
      $table->foreignId('tipo_empresa_id')->constrained('tipo_empresa')->onDelete('cascade');
      $table->boolean('status'); //status-instatus
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
    Schema::dropIfExists('empresas');
  }
}
