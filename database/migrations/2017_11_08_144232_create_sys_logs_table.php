<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_logs', function (Blueprint $table) {
            $table->BigIncrements('id');

            $table->enum('acao',['C', 'R', 'U', 'D' ]);

            $table->string('tabela');
            $table->integer('chave')    ->unsigned();
            $table->string('campo')     ->nullable();
            $table->text('valor_antigo')->nullable();
            $table->text('motivo')      ->nullable();

            $table->string('ip');
            $table->string('maquina');
            $table->string('local_user');



            //------------------------FOREIGN--------------------------------
            $table->integer('funcionario_id')   ->unsigned();
            //---------------------------------------------------------------
            $table->timestamps();
        });

        Schema::table('sys_logs', function($table){
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_logs');
    }
}
