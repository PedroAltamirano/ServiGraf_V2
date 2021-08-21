<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioProcesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_proceso', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios');
            $table->unsignedMediumInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios');
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
        Schema::dropIfExists('usuario_proceso');
    }
}
