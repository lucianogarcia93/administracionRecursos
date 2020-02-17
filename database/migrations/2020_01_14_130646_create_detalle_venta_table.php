<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {

            $table->increments('iddetalle_venta');

            $table->unsignedInteger('idventa')->nullable();
            $table->foreign('idventa')->references('idventa')->on('venta')->onDelete('cascade');

            $table->unsignedInteger('idarticulo')->nullable();
            $table->foreign('idarticulo')->references('idarticulo')->on('articulo')->onDelete('cascade');

            $table->integer('cantidad');
            $table->decimal('precio_venta');
            $table->decimal('descuento');

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
        Schema::dropIfExists('detalle_venta');
    }
}
