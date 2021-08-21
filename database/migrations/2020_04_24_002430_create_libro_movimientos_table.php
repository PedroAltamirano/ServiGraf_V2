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
            $table->boolean('tipo')->comment('1:ingreso, 0:egreso');
            $table->unsignedDecimal('ingreso', 7, 2)->nullable();
            $table->unsignedDecimal('egreso', 7, 2)->nullable();
            $table->unsignedMediumInteger('banco_id');
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->unsignedInteger('cuenta')->nullable();
            $table->unsignedInteger('cheque')->nullable();
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
        Schema::dropIfExists('libro_movimientos');
    }
}
