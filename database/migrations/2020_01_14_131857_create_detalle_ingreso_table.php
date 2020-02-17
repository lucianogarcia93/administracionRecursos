<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso', function (Blueprint $table) {

            $table->increments('iddetalle_ingreso');

            $table->unsignedInteger('ingreso_idingreso')->nullable();
            $table->foreign('ingreso_idingreso')->references('idingreso')->on('ingreso')->onDelete('cascade');

            $table->unsignedInteger('articulo_idarticulo')->nullable();
            $table->foreign('articulo_idarticulo')->references('idarticulo')->on('articulo')->onDelete('cascade');

            $table->integer('cantidad');
            $table->decimal('precio_compra');
            $table->decimal('precio_venta');


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
        Schema::dropIfExists('detalle_ingreso');
    }
}
