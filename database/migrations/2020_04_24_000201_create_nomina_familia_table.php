<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaFamiliaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBempresas')->create('nomina_familia', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->timestamps();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas_v2.empresas');
            $table->unsignedInteger('nomina_id');
            $table->foreign('nomina_id')->references('cedula')->on('empresas_v2.nomina');
            $table->unsignedTinyInteger('relacion'); //1padre, 2madre, 3conyuge, 4hijo, 5otros
            $table->string('nombre', 100);
            $table->date('fecha_nacimiento');
            $table->string('ocupacion', 50);
            $table->unsignedInteger('telefono')->nullable($value = true);
            $table->unsignedInteger('celular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBempresas')->dropIfExists('nomina_familia');
    }
}
