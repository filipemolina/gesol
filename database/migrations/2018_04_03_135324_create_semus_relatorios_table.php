<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemusRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::create('semus_relatorios', function (Blueprint $table) {
            
            $table->increments('id');

            $table->text('responsavel')                 ->nullable();
            $table->text('relato')                      ->nullable();
            $table->date('data')                        ->nullable();
            $table->time('hora')                        ->nullable();
            $table->enum('prioridade',[
                                'Amarelo',
                                'Azul',
                                'Verde',
                                'Vermelho',
                                ])                      ->nullable();

            $table->enum('unidade',[
                                'CMS Paraná'
                                'ESF Walter Borges'
                                'Farmácia & Laboratório Municipal'
                                'Laboratório Central de Mesquita'
                                'Policlínica Municipal Celestina José Ricardo Rosa'
                                'PSF Edson Passos'
                                'PSF Jacutinga'
                                'PSF Maria Cristina'
                                'PSF Santo Elias'
                                'PSF Sete Anões'
                                'SAMU'
                                'UBS Alto Uruguai'
                                'UBS Banco de Areia'
                                'UBS BNH'
                                'UBS Coréia'
                                'UBS Cosmorama'
                                'UBS Edson Passos'
                                'UBS FRANÇA LEITE'
                                'UBS Jorge Campos'
                                'UBS Juscelino'
                                'UBS Nossa Senhora Das Graças'
                                'UBS Parque Ludolf'
                                'UBS Santa Terezinha'
                                'UBS Vila Emil II'
                                'UBS Vila Norma'
                                'Unidade de Saúde Dr. Mário Bento'
                                ])                      ->nullable();

            //------------------------FOREIGN--------------------------------
  
            //---------------------------------------------------------------

            $table->timestamps();

            

        });

        // Schema::table('semsop_relatorios', function($table){
        //     $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('semus_relatorios');
    }
}