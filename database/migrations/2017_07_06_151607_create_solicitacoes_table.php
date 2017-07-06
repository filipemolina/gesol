<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Solicitacoes', function (Blueprint $table) {
            $table->increments('id');


            $table->binary('foto')                          ->nullable();
            $table->string('conteudo')                      ->nullable();
            $table->string('status', 15)                    ->nullable();
            $table->unsignedInteger('prioridade')           ->nullable();

            //------------------------FOREIGN--------------------------------
            $table->integer('servico_id')->unsigned()->nullable();
            $table->integer('solicitante_id')->unsigned()->nullable();

            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade');
            //---------------------------------------------------------------


            $table->softDeletes();
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
         Schema::dropIfExists('solicitacoes');    
    }
}
