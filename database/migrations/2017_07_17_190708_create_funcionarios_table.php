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
            $table->string('matricula', 11)                 ->nullable();
            $table->mediumtext('foto')                      ->nullable();

            $table->enum('tipo',['Efetivo','Comissionado','Externo','Sistema'])->default('Efetivo');

            //------------------------FOREIGN--------------------------------
            $table->integer('cargo_id')->unsigned();
            $table->integer('setor_id')->unsigned();
            $table->integer('role_id') ->nullable()->unsigned();            
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
