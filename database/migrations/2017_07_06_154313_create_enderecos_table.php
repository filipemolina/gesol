<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');

             //-----------------------------ENDEREÇO-----------------------
            $table->string('uf', 2)                         ->nullable();
            $table->string('municipio',30)                  ->nullable();
            $table->string('bairro',20)                     ->nullable();
            $table->string('logradouro',100)                ->nullable();
            $table->unsignedMediumInteger('numero')         ->nullable();
            $table->string('complemento',10)                ->nullable();
            $table->char('cep',10)                          ->nullable();


            //------------------------FOREIGN--------------------------------
            $table->integer('solicitante_id')->unsigned()->nullable();
            $table->integer('solicitacao_id')->unsigned()->nullable();
            $table->integer('secretaria_id')->unsigned()->nullable();
            //---------------------------------------------------------------

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
        Schema::dropIfExists('enderecos');
    }
}

