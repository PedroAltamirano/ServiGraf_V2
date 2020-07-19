<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBusuarios')->create('usuario_servicio', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamps();
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios');
            $table->unsignedMediumInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('produccion_v2.servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBusuarios')->dropIfExists('usuario_servicio');
    }
}
