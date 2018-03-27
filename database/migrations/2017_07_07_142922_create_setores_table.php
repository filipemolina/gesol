<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setores', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome',50);

            $table->boolean('oculto')->default(false);

            $table->string('icone')->default("leaf");

            $table->string('cor')->default('#3D276B');

            $table->boolean('operante')                        ->default(false);

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
        Schema::dropIfExists('setores');
    }
}
