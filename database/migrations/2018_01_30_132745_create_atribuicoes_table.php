<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtribuicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribuicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("atribuicao", 20);
            $table->string("descricao", 254);
            
            //------------------------FOREIGN--------------------------------
            $table->integer('role_id')->unsigned();
            $table->integer('secretaria_id')->unsigned();
            //------------------------FOREIGN--------------------------------

            $table->timestamps();
        });

        Schema::table('atribuicoes', function($table){
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('set null');
            $table->foreign('role_id') ->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atribuicoes');
    }
}
