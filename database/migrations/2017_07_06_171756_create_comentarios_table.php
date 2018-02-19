<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->BigIncrements('id');

            $table->text('comentario');
            $table->boolean('encerramento')->nullable();
            $table->boolean('lida')->default(false);
            $table->boolean('apagado')->default(false);


            //------------------------FOREIGN--------------------------------
            $table->integer('solicitacao_id')->unsigned();
            $table->integer('funcionario_id')->unsigned()->nullable();
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
        Schema::dropIfExists('comentarios');
    }
}
