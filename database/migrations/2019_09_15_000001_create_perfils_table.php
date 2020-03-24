<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBusuarios')->create('perfiles', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamp('creacion');
            $table->timestamp('modificacion');
            $table->string('empresa_id', 6);
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->string('perfil', 50);
            $table->string('descripcion', 140);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBusuarios')->dropIfExists('perfiles');
    }
}
