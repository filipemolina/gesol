<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->BigIncrements('id');

            $table->string('mensagem',30);
            $table->boolean('encerramento')->nullable();
            $table->boolean('lida')->default(false);


            //------------------------FOREIGN--------------------------------
            $table->integer('solicitacao_id')->unsigned();
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
        Schema::dropIfExists('mensagens');
    }
}
