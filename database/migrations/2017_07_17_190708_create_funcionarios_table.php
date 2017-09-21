<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');                
            $table->char('cpf',14)                          ->nullable();
            $table->unsignedInteger('matricula')            ->nullable();

            $table->enum('acesso',
                    ["TI","Prefeito","Ouvidor", "Secretario",
                    "Funcionario","SAC","Moderador","Desativado"])->default("Desativado");        

            $table->string('cargo',30)                      ->nullable();
            $table->mediumtext('foto')                      ->nullable();

            //------------------------FOREIGN--------------------------------
            $table->integer('setor_id')->unsigned();
            //---------------------------------------------------------------



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
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('funcionarios');
    }
}
