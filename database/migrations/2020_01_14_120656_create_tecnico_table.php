<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnico', function (Blueprint $table) {
            $table->increments('idtecnico');

            $table->unsignedInteger('persona_idpersona');
            $table->foreign('persona_idpersona')->references('idpersona')->on('persona')->onDelete('cascade');

            $table->integer('idpersona')->nullable();
            $table->string('nombre',45)->nullable();
            $table->string('tipo_documento',45)->nullable();
            $table->string('num_documento',45)->nullable();
            $table->string('telefono',45)->nullable();
            $table->string('email',45)->nullable();
            $table->string('especializacion',45);

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
        Schema::dropIfExists('tecnico');
    }
}
