<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibroMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios');
            $table->unsignedMediumInteger('libro_id');
            $table->foreign('libro_id')->references('id')->on('libros');
            $table->unsignedSmallInteger('libro_ref_id');
            $table->foreign('libro_ref_id')->references('id')->on('libro_refs');
            $table->date('fecha');
            $table->string('beneficiario', 50);
            $table->unsignedInteger('ci');
            $table->string('detalle', 140);
            $table->unsignedDecimal('ingreso', 7, 2);
            $table->unsignedDecimal('egreso', 7, 2);
            $table->unsignedMediumInteger('banco_id');
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->unsignedInteger('cuenta');
            $table->unsignedInteger('cheque');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libro_movimientos');
    }
}
