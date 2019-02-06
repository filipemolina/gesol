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
            $table->string('matricula', 12)                 ->nullable();
            $table->mediumtext('foto')                      ->nullable();

            $table->enum('tipo',['Efetivo','Comissionado','Externo','Sistema'])->default('Efetivo');

            //------------------------FOREIGN--------------------------------
            $table->integer('cargo_id')->unsigned();
            $table->integer('setor_id')->unsigned();
            $table->integer('role_id') ->nullable()->unsigned();            
            //---------------------------------------------------------------
            $table->timestamps();
        });

        
        //para usar com postgres
   /*      DB::statement(" 
            ALTER TABLE funcionarios 
	            ALTER COLUMN tipo DROP DEFAULT,
	            ALTER COLUMN tipo type tp_tipo_funcionario USING (tipo::tp_tipo_funcionario),
	            ALTER COLUMN tipo SET DEFAULT 'Efetivo'
        "); */

        Schema::table('funcionarios', function($table){
            $table->foreign('setor_id')->references('id')->on('setores')->onDelete('cascade');
            $table->foreign('role_id') ->references('id')->on('roles')  ->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
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
