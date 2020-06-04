<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('DDBBempresas')->create('nomina_docs', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->timestamps();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas-v2.empresas');
            $table->unsignedInteger('nomina_id');
            $table->foreign('nomina_id')->references('cedula')->on('empresas-v2.nomina');
            $table->boolean('aviso_entrada')->default(0);
            $table->boolean('contrato_trabajo')->default(0);
            $table->boolean('solicitud_empleo')->default(0);
            $table->boolean('curriculum_vitae')->default(0);
            $table->boolean('cedula_identidad')->default(0);
            $table->boolean('papeleta_votacion')->default(0);
            $table->boolean('record_policial')->default(0);
            $table->boolean('libreta_militar')->default(0);
            $table->boolean('certificado_escolar')->default(0);
            $table->boolean('certificado_colegio')->default(0);
            $table->boolean('certificado_universitario')->default(0);
            $table->boolean('certificado_otros')->default(0);
            $table->boolean('referencia_empleos')->default(0);
            $table->boolean('referencia_personales')->default(0);
            $table->boolean('certificado_medico')->default(0);
            $table->boolean('aviso_salida')->default(0);
            $table->boolean('acta_finiquito')->default(0);
            $table->boolean('recivo_pago_acta_fini')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DDBBempresas')->dropIfExists('nomina_docs');
    }
}
