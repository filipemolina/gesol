<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();


            $table->char('cpf',11)                          ->nullable();
            $table->unsignedInteger('matricula')            ->nullable();
            $table->string('cargo',30)                      ->nullable();

            //------------------------FOREIGN--------------------------------
            $table->integer('secretaria_id')->unsigned()->nullable();
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
