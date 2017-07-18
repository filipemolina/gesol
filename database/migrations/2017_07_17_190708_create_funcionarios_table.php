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

            $table->char('cpf',11)                          ->nullable();
            $table->unsignedInteger('matricula')            ->nullable();
            $table->string('cargo',30)                      ->nullable();
            $table->string('foto')                          ->nullable();

            //------------------------FOREIGN--------------------------------
            $table->integer('secretaria_id')->unsigned();
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
