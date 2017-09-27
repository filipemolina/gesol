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

            $table->string('campo_alterado')    ->nullable();
            $table->text('valor_antigo')      ->nullable();
            
            $table->enum('andamento',[
                                'Liberou', 
                                'Bloqueou', 
                                'Encaminhou',
                                'Fechou',
                                'Respondeu',
                                'Alterou'

                            ]);


            //------------------------FOREIGN--------------------------------
            $table->integer('solicitacao_id')   ->unsigned();
            $table->integer('funcionario_id')   ->unsigned();
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
