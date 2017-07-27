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
            $table->string('email',100)                     ->unique();
            $table->string('fb_uid')                        ->unique();
            $table->text('fb_token');

            $table->enum('sexo',[
                                    'Feminino', 
                                    'Masculino', 
                                    'Outros'
                                ])                          ->nullable();

            
            $table->string('foto')                          ->nullable();

            $table->enum('status', ['Criado', 'Ativo', 'Inativo']) ->default('Criado');



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
            
            //-----------------------------DOCUMENTOS----------------------            
            $table->char('cpf',14)                          ->nullable();

            $table->string('rg',20)                         ->nullable();
            $table->date('emissao_rg')                      ->nullable();
            $table->string('orgao_emissor_rg',30)           ->nullable();

            $table->string('titulo_eleitor',10)             ->nullable();
            $table->date('emissao_titulo')                  ->nullable();
            $table->unsignedInteger('zona_eleitoral')       ->nullable();


            //----------------------------PESSOAIS---------------------------
            $table->date('nascimento')                      ->nullable();
            $table->string('naturalidade',100)               ->nullable();
            $table->string('nacionalidade',50)              ->nullable();
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


            
            
