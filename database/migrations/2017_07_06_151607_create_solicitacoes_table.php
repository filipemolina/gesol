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


            $table->mediumText('foto')                                          ->nullable();
            $table->text('conteudo')                                            ->nullable();
            $table->boolean('moderado')                                         ->default(false);
            $table->enum('status', [
                                        'Aberta','Em análise','Em execução','Solucionada','Recusada','Encaminhada',
                                    ])                                          ->default('Aberta');

            $table->enum('prioridade',['Baixa','Normal','Alta','Urgente'])      ->default('Baixa');
            $table->tinyInteger('prazo')->nullable();
            
            //------------------------FOREIGN--------------------------------
            $table->integer('servico_id')->unsigned();
            $table->integer('solicitante_id')->unsigned();
            //---------------------------------------------------------------


            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('solicitacoes', function($table){
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade');
        });


        //para usar com postgres
        /* DB::statement(" 
            ALTER TABLE solicitacoes 
	            ALTER COLUMN status DROP DEFAULT,
	            ALTER COLUMN status type tp_status_solicitacao USING (status::tp_status_solicitacao),
	            ALTER COLUMN status SET DEFAULT 'Aberta'
        ");

        DB::statement(" 
            ALTER TABLE solicitacoes 
	            ALTER COLUMN prioridade DROP DEFAULT,
	            ALTER COLUMN prioridade type tp_prioridade_solicitacao USING (prioridade::tp_prioridade_solicitacao),
	            ALTER COLUMN prioridade SET DEFAULT 'Baixa'
        "); */
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
