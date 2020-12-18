<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina', function (Blueprint $table) {
            $table->unsignedBigInteger('empresa_id');
            //DATOS PERSONALES
            $table->unsignedInteger('cedula')->primary();
            $table->string('foto')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento', 100);
            $table->string('nacionalidad', 50);
            $table->string('idioma_nativo', 50);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('direccion');
            $table->string('sector', 30);
            $table->boolean('visita_domiciliaria')->default(0);
            $table->date('fecha_visita')->nullable();
            $table->unsignedInteger('telefono')->nullable();
            $table->unsignedInteger('celular');
            $table->string('correo')->unique();
            $table->unsignedTinyInteger('tipo_sangre'); //1A+, 2...
            $table->text('padecimientos_medicos')->nullable();
            $table->unsignedTinyInteger('genero'); //1masculino, 2femenino
            //estado civil
            $table->unsignedTinyInteger('estado_civil'); //1soltero, 2casado, 3divo, 4viudo, 5union libre
            $table->unsignedTinyInteger('cant_hijos')->nullable();
            //DATOS RMPRESARIALES
            $table->date('inicio_labor');
            $table->date('fin_labor')->nullable();
            $table->string('cargo', 50);
            $table->unsignedTinyInteger('centro_costos'); //1administracion, 2produccion, 3ventas
            $table->date('ingreso_iess')->nullable();
            $table->boolean('iess_asumido_empleador');
            $table->unsignedDecimal('sueldo', 6, 2);
            $table->boolean('liquidacion_mensual')->default(1); //pago de decimos mes a mes
            //pago
            $table->unsignedTinyInteger('banco_id');
            $table->unsignedTinyInteger('tipo_cuenta_banco'); //1ahorros, 2corriente
            $table->string('numero_cuenta_bancaria', 20);
            $table->string('observaciones')->nullable();
            //permisos adicionales
            $table->boolean('status')->default(1); //estado del empeado
            $table->unsignedMediumInteger('horario_id')->default(0);
            $table->boolean('Txhoras')->default(0);
            $table->timestamps();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('horario_id')->references('id')->on('horarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomina');
    }
}
