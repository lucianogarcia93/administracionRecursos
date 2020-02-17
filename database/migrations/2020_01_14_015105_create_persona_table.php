<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            
            $table->increments('idpersona');
            $table->string('tipo_persona',20);
            $table->string('nombre',100);
            $table->string('tipo_documento',20)->nullable();;
            $table->string('num_documento',50)->nullable();;
            $table->string('direccion',70)->nullable();;
            $table->integer('telefono')->nullable();;
            $table->string('email',50)->nullable();;
            $table->integer('puntuacion')->nullable();;

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
        Schema::dropIfExists('persona');
    }
}
