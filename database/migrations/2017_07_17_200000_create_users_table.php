<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            $table->enum('status',['Ativo','Inativo',])->default('Inativo');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->mediumText('avatar')->nullable();

            //------------------------FOREIGN--------------------------------
            $table->integer('funcionario_id')   ->nullable()->unsigned();
            $table->integer('solicitante_id')   ->nullable()->unsigned();
            //------------------------FOREIGN--------------------------------

            
            $table->timestamps();
        });

        //para usar com postgres
      /*   DB::statement(" 
            ALTER TABLE users 
	            ALTER COLUMN status DROP DEFAULT,
	            ALTER COLUMN status type tp_status USING (status::tp_status),
	            ALTER COLUMN status SET DEFAULT 'Inativo'
        "); */

        Schema::table('users', function($table){
            $table->foreign('funcionario_id')   ->references('id')->on('funcionarios')  ->onDelete('cascade');
            $table->foreign('solicitante_id')   ->references('id')->on('solicitantes')  ->onDelete('cascade');
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
