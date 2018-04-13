<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemusRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::create('semus_relatorios', function (Blueprint $table) {
            
            $table->increments('id');

            $table->text('responsavel')                 ->nullable();
            $table->text('relato')                      ->nullable();
            $table->date('data')                        ->nullable();
            $table->time('hora')                        ->nullable();
            $table->boolean('enviado')                  ->default(false);

            //------------------------FOREIGN--------------------------------
            $table->integer('funcionario_id')->unsigned();
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')  ->onDelete('cascade');
            //---------------------------------------------------------------

            $table->timestamps();

            

        });

        // Schema::table('semsop_relatorios', function($table){
        //     $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('semus_relatorios');
    }
}