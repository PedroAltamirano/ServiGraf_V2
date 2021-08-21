<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuloPerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_perfil', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfiles');
            $table->unsignedTinyInteger('modulo_id');
            // $table->foreign('modulo_id')->references('id')->on('modulos');
            $table->unsignedTinyInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('roles');
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
        Schema::dropIfExists('modulo_perfil');
    }
}
