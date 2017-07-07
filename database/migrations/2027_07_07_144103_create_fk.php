<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFk extends Migration
{

    public function up()
    {

        Schema::table('servicos', function($table){
            $table->foreign('setor_id')->references('id')->on('setores')->onDelete('cascade');
        });


        Schema::table('solicitacoes', function($table){
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade');
        });


        Schema::table('enderecos', function($table){
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade');
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
        });

        
        Schema::table('users', function($table){
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
        });

        Schema::table('mensagens', function($table){
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
        });

        Schema::table('setores', function($table){
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
        });
            
    }


    public function down()
    {


        Schema::table('servicos', function($table){
            $table->dropForeign('servicos_setor_id_foreign');   
        });


        Schema::table('solicitacoes', function($table){
            $table->dropForeign('solicitacoes_servico_id_foreign');
            $table->dropForeign('solicitacoes_solicitante_id_foreign');   
        });


        Schema::table('enderecos', function($table){
            $table->dropForeign('enderecos_secretaria_id_foreign');
            $table->dropForeign('enderecos_solicitacao_id_foreign');
            $table->dropForeign('enderecos_solicitante_id_foreign');
        });

        
        Schema::table('users', function($table){
           $table->dropForeign('users_secretaria_id_foreign');
        });

        Schema::table('mensagens', function($table){
            $table->dropForeign('mensagens_solicitacao_id_foreign');           
        });

        Schema::table('setores', function($table){
            $table->dropForeign('setores_secretaria_id_foreign');   
        });


        
    }

}




// ======================================================================

class FkTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('irmao', function($table){
            $table->foreign('fk_loja_iniciacao')->references('id')->on('loja');
            $table->foreign('fk_loja_elevacao')->references('id')->on('loja');
            $table->foreign('fk_loja_exaltacao')->references('id')->on('loja');
            $table->foreign('fk_loja_instalacao')->references('id')->on('loja');
        });



        Schema::table('dependente', function($table){

            $table->foreign('fk_id_irmao')->references('id')->on('irmao');
        });


        Schema::table('email', function($table){

            $table->foreign('fk_id_irmao')->references('id')->on('irmao');
            $table->foreign('fk_id_loja')->references('id')->on('loja');
            $table->foreign('fk_id_dependente')->references('id')->on('dependente');
            $table->foreign('fk_id_visitante')->references('id')->on('visitante');
        });

        Schema::table('endereco', function($table){

            $table->foreign('fk_id_pais')->references('id')->on('pais');
            $table->foreign('fk_id_uf')->references('id')->on('uf');
            $table->foreign('fk_id_municipio')->references('id')->on('municipio');
            $table->foreign('fk_id_bairro')->references('id')->on('bairro');
            $table->foreign('fk_id_irmao')->references('id')->on('irmao');
            $table->foreign('fk_id_loja')->references('id')->on('loja');
            $table->foreign('fk_id_visitante')->references('id')->on('visitante');
        });

        Schema::table('ocupacao_cargo', function($table){
            $table->foreign('fk_id_irmao')->references('id')->on('irmao');
            $table->foreign('fk_id_cargo')->references('id')->on('cargo');
        });

        Schema::table('presenca_sessao', function($table){
            $table->foreign('fk_id_sessao')->references('id')->on('sessao');
            $table->foreign('fk_id_irmao')->references('id')->on('irmao');
            $table->foreign('fk_id_cargo')->references('id')->on('cargo');
        });


        Schema::table('telefone', function($table){
            $table->foreign('fk_id_irmao')->references('id')->on('irmao');
            $table->foreign('fk_id_loja')->references('id')->on('loja');
            $table->foreign('fk_id_dependente')->references('id')->on('dependente');
            $table->foreign('fk_id_visitante')->references('id')->on('visitante');
        });

        Schema::table('visita', function($table){
            $table->foreign('fk_id_visitante')->references('id')->on('visitante');
        });


        Schema::table('visitante', function($table){
            $table->integer('fk_id_loja')->unsigned();
            $table->foreign('fk_id_loja')->references('id')->on('loja');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}