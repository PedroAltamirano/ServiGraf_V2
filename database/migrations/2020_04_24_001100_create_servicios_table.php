<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->unsignedMediumInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->string('servicio', 140);
            $table->unsignedDecimal('meta', 7, 2)->default(0.00);
            $table->boolean('tipo')->default(1); //interno o externo
            $table->boolean('subprocesos')->default(0);
            $table->boolean('seguimiento')->default(0);
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
        Schema::dropIfExists('servicios');
    }
}
