<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->increments('id');

            $table->string('mensagem',30);
            $table->boolean('encerramento')->nullable();


            //------------------------FOREIGN--------------------------------
            $table->integer('solicitacao_id')->unsigned()->nullable();

            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
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
        Schema::dropIfExists('mensagens');
    }
}
