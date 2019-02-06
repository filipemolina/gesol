<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentos', function (Blueprint $table) {
            $table->BigIncrements('id');

            $table->string('campo_alterado')    ->nullable();
            $table->text('valor_antigo')        ->nullable();
            $table->text('motivo')              ->nullable();
            
            $table->enum('andamento',[
                                'Liberou', 
                                'Bloqueou', 
                                'Redirecionou',
                                'Fechou',
                                'Respondeu',
                                'Alterou',
                                'Recusou',
                                'Leu',
                            ]);


            //------------------------FOREIGN--------------------------------
            $table->integer('solicitacao_id')   ->unsigned();
            $table->integer('funcionario_id')   ->unsigned()    ->nullable();
            $table->integer('solicitante_id')   ->unsigned()    ->nullable();
            $table->bigInteger('comentario_id') ->unsigned()    ->nullable();
            //---------------------------------------------------------------

            $table->timestamps();
        });
       
        //para usar com postgres
       /*  DB::statement(" 
            ALTER TABLE movimentos 
	            ALTER COLUMN andamento DROP DEFAULT,
	            ALTER COLUMN andamento type tp_andamento USING (andamento::tp_andamento)
        "); */

        Schema::table('movimentos', function($table){
            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->foreign('comentario_id')->references('id')->on('comentarios')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentos');
    }
}
