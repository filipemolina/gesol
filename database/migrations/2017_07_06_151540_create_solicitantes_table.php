<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitantes', function (Blueprint $table) {
            $table->increments('id');


            $table->string('nome',50);
            $table->string('email')                         ->unique();
            $table->string('uid')                           ->unique();
            $table->string('token')                         ->unique();
            $table->string('celular',15)                    ->unique();

            $table->enum('sexo',[
                                    'Feminino', 
                                    'Masculino', 
                                    'Outros'
                                ])                          ->nullable();

            $table->string('telefone', 15)                  ->nullable();
            $table->binary('foto')                          ->nullable();

            $table->string('status', 15)                    ->nullable();



            //-----------------------------SISTEMA HABITAÇÃO-------------
            $table->boolean('mulher_responsavel')           ->nullable();
            $table->float('renda_familiar',8,2)             ->nullable();
            $table->date('tempo_residencia')                ->nullable();
            $table->boolean('necessidades_especiais')       ->nullable();
            $table->string('tipo_deficiencia')              ->nullable();
            $table->char('nis',20)->nullable()              ->nullable();
            $table->char('ctps',20)->nullable()             ->nullable();
            $table->boolean('bolsa_familia')                ->nullable();
            $table->float('vr_bolsa')->nullable()           ->nullable();
            $table->integer('codigo_inscricao')             ->nullable();
            
            //----------------------------SISTEMA CURRICULO---------------
            $table->string('titulo', 30)                    ->nullable();
            $table->string('indicacao_politica')            ->nullable();


            //-----------------------------DOCUMENTOS----------------------            
            $table->char('cpf',11)                          ->nullable();

            $table->string('identidade',20)                 ->nullable();
            $table->date('emissao_idt')                     ->nullable();
            $table->string('orgao_emissor_idt',10)          ->nullable();

            $table->string('titulo_eleitor',10)             ->nullable();
            $table->date('emissao_titulo')                  ->nullable();
            $table->unsignedInteger('zona_eleitoral')       ->nullable();


            //----------------------------PESSOAIS---------------------------
            $table->date('nascimento')                      ->nullable();
            $table->string('naturalidade',20)               ->nullable();
            $table->string('nacionalidade',20)              ->nullable();
            $table->string('pai',50)                        ->nullable();
            $table->string('mae',50)                        ->nullable();
            $table->enum('estado_civil', [
                'Solteiro(a)',
                'Casado(a)', 
                'Divorciado(a)',
                'Viúvo(a)',
                'Separado(a)',
                'União estável'
                                        ])                  ->nullable();


            
            $table->string('profissao',50)                  ->nullable();


            $table->enum('escolaridade', [

                'Fundamental - Incompleto',
                'Fundamental - Completo',
                'Médio - Incompleto',
                'Médio - Completo',
                'Superior - Incompleto',
                'Superior - Completo',
                'Pós-graduação - Incompleto',
                'Pós-graduação - Completo',
                'Mestrado - Incompleto',
                'Mestrado - Completo',
                'Doutorado - Incompleto',
                'Doutorado - Completo'
                                        ])                  ->nullable();






            $table->softDeletes();

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
        Schema::dropIfExists('solicitantes');
    }
}


            
            
