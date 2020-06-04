<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBempresas')->create('empresas', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); //ruc
            $table->timestamps();
            $table->string('nombre', 30);
            $table->unsignedTinyInteger('tipo_empresa_id');
            $table->foreign('tipo_empresa_id')->references('id')->on('tipo_empresa');
            $table->boolean('status'); //status-instatus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBempresas')->dropIfExists('empresas');
    }
}