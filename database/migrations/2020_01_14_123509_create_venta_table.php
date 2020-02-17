<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('idventa');

            $table->unsignedInteger('idcliente')->nullable();
            $table->foreign('idcliente')->references('idpersona')->on('persona')->onDelete('cascade');

            $table->string('tipo_comprobante');
            $table->string('serie_comprobante');
            $table->string('num_comprobate');
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto');
            $table->decimal('total_venta');
            $table->string('estado');

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
        Schema::dropIfExists('venta');
    }
}
