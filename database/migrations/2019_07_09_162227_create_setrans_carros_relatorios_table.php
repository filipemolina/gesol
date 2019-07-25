<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetransCarrosRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setrans_carros_relatorios', function (Blueprint $table){
            $table->integer('carro_id')->unsigned();
            $table->integer('setrans_relatorio_id')->unsigned();
            $table->string('km_inicial');
            $table->string('km_final');

            $table->foreign('carro_id')->references('id')->on('setrans_carros')->onDelete('cascade');
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
