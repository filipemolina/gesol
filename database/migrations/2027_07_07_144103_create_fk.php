<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFk extends Migration
{

    public function up()
    {

       /*  Schema::table('servicos', function($table){
            $table->foreign('setor_id')->references('id')->on('setores')->onDelete('cascade');
        }); */


        /* Schema::table('solicitacoes', function($table){
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade');
        }); */


        /* Schema::table('enderecos', function($table){
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade');
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
        }); */

        
        /* Schema::table('funcionarios', function($table){
            $table->foreign('setor_id')->references('id')->on('setores')->onDelete('cascade');
            $table->foreign('role_id') ->references('id')->on('roles')  ->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
        }); */
        

        /* Schema::table('comentarios', function($table){
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        }); */

       /*  Schema::table('setores', function($table){
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
        }); */

        /* Schema::table('users', function($table){
            $table->foreign('funcionario_id')   ->references('id')->on('funcionarios')  ->onDelete('cascade');
            $table->foreign('solicitante_id')   ->references('id')->on('solicitantes')  ->onDelete('cascade');
        }); */
            
        /* Schema::table('telefones', function($table){
            $table->foreign('solicitante_id')   ->references('id')->on('solicitantes')  ->onDelete('cascade');
            $table->foreign('secretaria_id')    ->references('id')->on('secretarias')   ->onDelete('cascade');
            $table->foreign('setor_id')         ->references('id')->on('setores')       ->onDelete('cascade');
        }); */

        /* Schema::table('apoios', function($table){
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade');
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
        }); */

        /* Schema::table('movimentos', function($table){
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->foreign('comentario_id')->references('id')->on('comentarios')->onDelete('cascade');            
        }); */

        /* Schema::table('sys_logs', function($table){
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        }); */

        /* Schema::table('atribuicoes', function($table){
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('set null');
            $table->foreign('role_id') ->references('id')->on('roles')->onDelete('set null');
        }); */

        /* Schema::table('atribuicao_funcionario', function($table){
            $table->foreign('atribuicao_id')    ->references('id')->on('atribuicoes')  ->onDelete('cascade');
            $table->foreign('funcionario_id')   ->references('id')->on('funcionarios')  ->onDelete('cascade');
        }); */

        /* Schema::table('semsop_funcionarios_relatorios', function($table){
            $table->foreign('semsop_relatorio_id')->references('id')->on('semsop_relatorios')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        }); */

        /* Schema::table('semsop_relatorios', function($table){
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
        }); */

       /*  Schema::table('cargos', function($table){
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
        }); */
        



        Schema::enableForeignKeyConstraints();
    }


    public function down()
    {

        Schema::disableForeignKeyConstraints();

/*        Schema::table('setores', function($table){
            $table->dropForeign('setores_secretaria_id_foreign'); 
        });


        Schema::table('enderecos', function($table){
            $table->dropForeign('enderecos_secretaria_id_foreign');
            $table->dropForeign('enderecos_solicitacao_id_foreign');
            $table->dropForeign('enderecos_solicitante_id_foreign');
        });




        
        Schema::table('users', function($table){
           $table->dropForeign('users_secretaria_id_foreign');
        });

        Schema::table('comentarios', function($table){
            $table->dropForeign('comentarios_solicitacao_id_foreign');           
        });

        Schema::table('setores', function($table){
            $table->dropForeign('setores_secretaria_id_foreign');   
        });

        Schema::table('users', function($table){
            $table->dropForeign('users_funcionarios_id_foreign'); 
            $table->dropForeign('users_solicitantes_id_foreign'); 
        });


        Schema::table('servicos', function($table){
            $table->dropForeign('servicos_setor_id_foreign');   
        });


        Schema::table('solicitacoes', function($table){
            $table->dropForeign('solicitacoes_servico_id_foreign');
            $table->dropForeign('solicitacoes_solicitante_id_foreign');   
        });
*/
    }
}

