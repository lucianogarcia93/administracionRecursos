<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {

            $table->increments('idarticulo');

            $table->unsignedInteger('categoria_idcategoria')->nullable();
            $table->foreign('categoria_idcategoria')->references('idcategoria')->on('categoria')->onDelete('cascade');

            $table->string('codigo',50)->nullable();
            $table->string('nombre',100);
            $table->integer('stock');
            $table->string('descripcion',256)->nullable();
            $table->string('imagen',50)->nullable();
            $table->string('estado',20);
            $table->date('fecha_venc')->nullable();

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
        Schema::dropIfExists('articulo');
    }
}
