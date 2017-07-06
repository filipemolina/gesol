<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecretariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretarias', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome',50);
            $table->string('secretario',50)                 ->nullable();
            $table->string('sigla', 10)                     ->nullable();
            $table->string('email')                         ->nullable();
            $table->string('telefone', 15)                  ->nullable();
            $table->time('inicio_atendimento')              ->nullable();
            $table->time('termino_atendimento')             ->nullable();


           

            $table->softDeletes();

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
        Schema::dropIfExists('secretarias');
    }
}
