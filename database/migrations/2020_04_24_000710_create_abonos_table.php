<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBproduccion')->create('abonos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedDecimal('pedidos_id', 18, 5);
            $table->foreign('pedidos_id')->references('id')->on('pedidos');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('cedula')->on('usuarios_v2.usuarios');
            $table->string('forma_pago', 20);
            $table->decimal('valor', 8, 2)->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBproduccion')->dropIfExists('abonos');
    }
}
