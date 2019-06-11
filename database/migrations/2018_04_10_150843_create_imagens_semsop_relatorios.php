<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensSemsopRelatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens_semsop_relatorios', function (Blueprint $table) {
            $table->integer('imagem_id')->unsigned();
            $table->integer('semsop_relatorio_id')->unsigned();

            $table->foreign('imagem_id')->references('id')->on('imagens')->onDelete('cascade');
            $table->foreign('semsop_relatorio_id')->references('id')->on('semsop_relatorios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagens_semsop_relatorios');
    }
}
