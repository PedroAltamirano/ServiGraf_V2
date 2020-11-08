<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fact_prods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->unsignedSmallInteger('cantidad');
            $table->string('detalle', 50);
            $table->unsignedSmallInteger('iva_id');
            $table->foreign('iva_id')->references('id')->on('ivas');
            $table->decimal('valor_unitario', 9, 3)->unsigned();
            $table->decimal('subtotal', 9, 3)->unsigned();
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
        Schema::dropIfExists('fact_prods');
    }
}
