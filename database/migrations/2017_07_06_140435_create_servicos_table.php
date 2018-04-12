<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome',50);
            $table->tinyInteger('prazo')->nullable();
            
            $table->boolean('operante')                        ->default(false);
            //------------------------FOREIGN--------------------------------
            $table->integer('setor_id')->unsigned();
            //---------------------------------------------------------------

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('servicos', function($table){
            $table->foreign('setor_id')->references('id')->on('setores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicos');
    }
}
