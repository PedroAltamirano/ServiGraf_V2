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
            $table->timestamp('creacion');
            $table->timestamp('modificacion');
            //datos de usuario
            $table->unsignedInteger('cedula')->primary();;
            $table->string('nombre', 20);
            $table->string('apellido', 20);
            $table->string('correo', 50)->unique();
            $table->unsignedInteger('telefono');
            $table->string('imagen')->nullable($value = true);
            //datos de validacion
            $table->rememberToken();
            $table->string('empresa_id', 6);
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->string('usuario', 20)->unique();
            $table->string('password', 128);
            $table->unsignedMediumInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfiles');
            //permisos adicionales
            $table->boolean('activo')->default(1);
            $table->unsignedMediumInteger('horario_id')->default(0);
            $table->foreign('horario_id')->references('id')->on('horarios');
            $table->boolean('Txhoras')->default(0);
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
