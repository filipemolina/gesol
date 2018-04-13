<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtribuicaoFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribuicao_funcionario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('atribuicao_id')    ->unsigned();
            $table->integer('funcionario_id')   ->unsigned();
            $table->timestamps();

        });

        Schema::table('atribuicao_funcionario', function($table){
            $table->foreign('atribuicao_id')    ->references('id')->on('atribuicoes')  ->onDelete('cascade');
            $table->foreign('funcionario_id')   ->references('id')->on('funcionarios')  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atribuicao_funcionario');
    }
}
