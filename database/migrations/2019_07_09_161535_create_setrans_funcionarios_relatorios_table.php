<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetransFuncionariosRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setrans_funcionarios_relatorios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('funcionario_id')           ->unsigned();
            $table->integer('setrans_relatorio_id')     ->unsigned();
            $table->boolean('relator')                  ->default(false);
            $table->timestamps();
        });

        Schema::table('setrans_funcionarios_relatorios', function($table){
            $table->foreign('setrans_relatorio_id')->references('id')->on('setrans_relatorios')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('sisseg.funcionarios')->onDelete('cascade');
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
