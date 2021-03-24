<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaReferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_refer', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->unsignedInteger('nomina_id');
            $table->foreign('nomina_id')->references('cedula')->on('nomina');
            $table->boolean('tipo_refer');
            $table->string('empresa', 50)->nullable($value = true);
            $table->string('contacto', 100);
            $table->unsignedInteger('telefono_refer');
            $table->string('afinidad', 50);
            $table->date('inicio_labor_refer')->nullable($value = true);
            $table->date('fin_labor_refer')->nullable($value = true);
            $table->string('cargo_refer', 50);
            $table->string('razon_separacion', 250)->nullable($value = true);
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
        Schema::dropIfExists('nomina_refer');
    }
}
