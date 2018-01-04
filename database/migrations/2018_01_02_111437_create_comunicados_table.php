<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunicadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicados', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('imagem');
            $table->string('titulo', 255);
            $table->string('subtitulo', 255);
            $table->text('texto');
            $table->integer('num_dispositivos')->unsigned()->nullable();

            //------------------------FOREIGN--------------------------------
            $table->integer('funcionario_id')->unsigned();
            //---------------------------------------------------------------
            
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
        Schema::dropIfExists('comunicados');
    }
}
