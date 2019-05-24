<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensSemusRelatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('imagens_semus_relatorios', function (Blueprint $table) {
        //     $table->integer('imagem_id')->unsigned();
        //     $table->integer('semus_relatorios_id')->unsigned();

        //     $table->foreign('imagem_id')->references('id')->on('imagens')->onDelete('cascade');
        //     $table->foreign('semus_relatorios_id')->references('id')->on('imagens')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('imagens_semus_relatorios');
    }
}
