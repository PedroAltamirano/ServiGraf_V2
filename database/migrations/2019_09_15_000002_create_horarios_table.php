<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBusuarios')->create('horarios', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamp('creacion');
            $table->string('empresa_id', 6);
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->string('nombre', 30);
            $table->time('llegada_ma');
            $table->time('salida_ma');
            $table->time('llegada_ta');
            $table->time('salida_ta');
            $table->unsignedTinyInteger('espera');
            $table->unsignedTinyInteger('gracia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBusuarios')->dropIfExists('horarios');
    }
}
