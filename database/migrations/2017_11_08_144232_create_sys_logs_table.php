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

            //------------------------FOREIGN--------------------------------
            $table->integer('funcionario_id')   ->unsigned();
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
        Schema::dropIfExists('sys_logs');
    }
}
