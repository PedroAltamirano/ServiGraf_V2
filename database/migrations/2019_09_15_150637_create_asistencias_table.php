<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBusuarios')->create('asistencias', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('empresa_id', 6);
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios');
            $table->date('fecha');
            $table->time('llegada_mañana');
            $table->time('salida_mañana')->nullable();
            $table->time('llegada_tarde')->nullable();
            $table->time('salida_tarde')->nullable();
            $table->decimal('total', 4, 2)->unsigned()->default(0.0);
            $table->decimal('extras', 4, 2)->unsigned()->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBusuarios')->dropIfExists('asistencias');
    }
}
