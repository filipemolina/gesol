<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefones', function (Blueprint $table) {
            $table->increments('id');

            $table->char('numero', 15);
            
            $table->enum('tipo_telefone',['Fixo','Celular']);

            $table->integer('solicitante_id')->unsigned()->nullable();
            $table->integer('secretaria_id')->unsigned()->nullable();
            $table->integer('setor_id')->unsigned()->nullable();

       
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('telefones', function($table){
            $table->foreign('solicitante_id')   ->references('id')->on('solicitantes')  ->onDelete('cascade');
            $table->foreign('secretaria_id')    ->references('id')->on('secretarias')   ->onDelete('cascade');
            $table->foreign('setor_id')         ->references('id')->on('setores')       ->onDelete('cascade');
        });

        /* DB::statement(" 
            ALTER TABLE telefones 
	            ALTER COLUMN tipo_telefone DROP DEFAULT,
	            ALTER COLUMN tipo_telefone type tp_telefone USING (tipo_telefone::tp_telefone)
        "); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefones');
    }
}
