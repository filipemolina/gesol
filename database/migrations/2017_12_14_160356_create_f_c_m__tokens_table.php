<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFCMTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_c_m__tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string("token", 255);
            $table->string("navegador", 255)->nullable();
            $table->string("versao", 255)->nullable();
            $table->string("plataforma", 255)->nullable();

            // Chave Estrangeira
            $table->integer("user_id")->unsigned();
            
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
        Schema::dropIfExists('f_c_m__tokens');
    }
}
