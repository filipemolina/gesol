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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->increments('id');


            $table->string('foto')                                              ->nullable();
            $table->string('conteudo')                                          ->nullable();
            $table->enum('status', ['Aberta','Encaminhada',
                                    'Aguardando','Pendente',
                                    'Em execução','Fechada'])                   ->default('Aberta');

            $table->enum('prioridade',['Baixa','Normal','Alta','Urgente'])      ->default('Baixa');

            //------------------------FOREIGN--------------------------------
            $table->integer('servico_id')->unsigned();
            $table->integer('solicitante_id')->unsigned();
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
