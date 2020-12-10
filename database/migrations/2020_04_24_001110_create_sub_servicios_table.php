<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_servicios', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->time('tmaquina', 0)->nullable();
            $table->time('toperador', 0)->nullable();
            $table->string('subservicio', 30);
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
        Schema::dropIfExists('sub_servicios');
    }
}
