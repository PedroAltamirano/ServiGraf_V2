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
        Schema::connection('DDBBproduccion')->create('sub_servicios', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamp('creacion');
            $table->unsignedMediumInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->string('subservicio', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBproduccion')->dropIfExists('sub_servicios');
    }
}
