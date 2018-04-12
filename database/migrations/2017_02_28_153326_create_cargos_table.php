<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100);
            $table->enum('tipo',['E','C']) ->default('E'); //E = Efetivo, C = Comissionado 
            $table->integer('secretaria_id')->unsigned();
            $table->timestamps();
        });

        //para usar com postgres
        DB::statement(" 
            ALTER TABLE cargos 
	            ALTER COLUMN tipo DROP DEFAULT,
	            ALTER COLUMN tipo type tp_tipo_cargos USING (tipo::tp_tipo_cargos),
	            ALTER COLUMN tipo SET DEFAULT 'E'
        ");

        Schema::table('cargos', function($table){
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
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

        Schema::dropIfExists('cargos');
    }
}
