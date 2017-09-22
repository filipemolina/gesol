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
            $table->increments('id');
            
            $table->enum('andamento',[
                                'Liberou', 
                                'Bloqueaou', 
                                'Encaminhou',
                                'Fechou',
                                'Respondeu'

                            ]);


            //------------------------FOREIGN--------------------------------
            $table->integer('solicitacao_id')   ->unsigned();
            $table->integer('funcionario_id')   ->unsigned();
            $table->integer('servico_id')       ->unsigned()    ->nullable();
            $table->bigInteger('comentario_id') ->unsigned()    ->nullable();
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
        Schema::dropIfExists('movimentos');
    }
}
