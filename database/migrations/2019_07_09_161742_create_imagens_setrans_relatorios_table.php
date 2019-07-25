<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensSetransRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens_setrans_relatorios', function (Blueprint $table) {
            $table->integer('imagem_id')->unsigned();
            $table->integer('setrans_relatorio_id')->unsigned();

            $table->foreign('imagem_id')->references('id')->on('imagens')->onDelete('cascade');
            $table->foreign('setrans_relatorio_id')->references('id')->on('setrans_relatorios')->onDelete('cascade');
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
