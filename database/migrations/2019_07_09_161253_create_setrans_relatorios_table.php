<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetransRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setrans_relatorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string("numero", 15);
            $table->date('data')                          ->nullable();
            $table->time('hora')                          ->nullable();
            $table->text('registro_ocorrencia');
            $table->boolean('enviado')                    ->default(false);
            $table->text('outros')                        ->nullable();
            $table->string('cones',3)                     ->nullable();
            $table->string('bombonas',3)                  ->nullable();
            $table->string('radios',3)                    ->nullable();
            $table->string('placas',3)                    ->nullable();
            $table->string('lanternas',3)                 ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
