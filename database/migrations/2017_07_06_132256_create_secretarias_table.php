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

            $table->string('nome',100);
            $table->string('secretario',50)                 ->nullable();
            $table->string('sigla', 10)                     ->nullable();
            $table->string('email')                         ->nullable();
            $table->time('inicio_atendimento')              ->nullable()    ->default('09:00:00');
            $table->time('termino_atendimento')             ->nullable()    ->default('17:00:00');

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
