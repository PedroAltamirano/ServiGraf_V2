<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBusuarios')->create('usuarios', function (Blueprint $table) {
            $table->timestamps();
            //datos de usuario
            $table->unsignedInteger('cedula')->unique();
            $table->foreign('cedula')->references('cedula')->on('empresas-v2.nomina');
            //datos de validacion
            $table->rememberToken();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->string('usuario', 20)->unique();
            $table->string('password', 128);
            $table->unsignedMediumInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('usuarios-v2.perfiles');
            //permisos adicionales
            $table->boolean('status')->default(1);
            $table->boolean('reservarot')->default(0);
            $table->boolean('libro')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBusuarios')->dropIfExists('usuarios');
    }
}
