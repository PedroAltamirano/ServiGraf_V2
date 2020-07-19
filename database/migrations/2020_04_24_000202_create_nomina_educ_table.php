<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaEducTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBempresas')->create('nomina_educacion', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->timestamps();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas_v2.empresas');
            $table->unsignedInteger('nomina_id');
            $table->foreign('nomina_id')->references('cedula')->on('empresas_v2.nomina');
            $table->unsignedTinyInteger('nivel_educ'); //1primaria, 2secu, 3superior, 4maestria, 5diplomado, 6idiomas, 7otros
            $table->string('nombre_institucion', 100);
            $table->date('inicio');
            $table->date('fin');
            $table->string('titulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBempresas')->dropIfExists('nomina_educacion');
    }
}
