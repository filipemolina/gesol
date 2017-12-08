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
            $table->enum('uf',['AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO'])                ->default('RJ');


            $table->string('municipio',30)                  ->nullable();
            $table->string('bairro',20)                     ->nullable();
            $table->string('logradouro',100)                ->nullable();
            $table->unsignedMediumInteger('numero')         ->nullable();
            $table->string('complemento',20)                ->nullable();
            $table->char('cep',10)                          ->nullable();

            $table->decimal('latitude',10,8)                ->nullable();
            $table->decimal('longitude',10,8)               ->nullable();

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

