<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemsopFuncionariosRelatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semsop_funcionarios_relatorios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('funcionario_id')       ->unsigned();
            $table->integer('semsop_relatorio_id')  ->unsigned();
            $table->boolean('relator')              ->default(false);
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
        Schema::dropIfExists('semsop_funcionarios_relatorios');
    }
}
