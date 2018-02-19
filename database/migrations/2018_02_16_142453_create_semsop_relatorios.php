<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemsopRelatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::create('semsop_relatorios', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('notificacao')            ->nullable();
            $table->boolean('autuacao')               ->nullable();
            $table->boolean('multa')                  ->nullable();
            $table->boolean('registro_dp')            ->nullable();
            $table->boolean('auto_pf')                ->nullable();

            // $table->string('local')                   ->nullable();
            //TODO: usar a tabela de endereço existente
            $table->text('envolvidos')                ->nullable();
            
            $table->enum('origem',[
                                'Ordem de servico',
                                'Disque denuncia',
                                'Ouvidoria',
                                'Dever de oficio',
                                'Ordem imediata',
                                ])                    ->nullable();

            $table->enum('acao_gcmm',[
                                'Apoio em colisão de veiculos S/ vitima',
                                'Apoio em colisão de veiculos C/ vitima',
                                'Apoio em vitimas de atropelamento',
                                'Autos de infrações lavrados',
                                'Apoio div. a transeuntes em via/comercio',
                                'Apresentação de fantoches',
                                'Apresentação de palestra',
                                'Atendimentos extraordinarios(S/ oficio)',
                                'Atendimentos via oficios',
                                'Combate a incêndio urbano',
                                'Combate a incêndio florestal',
                                'Condução de cidadãos ao hospital',
                                'Conflito em escolas',
                                'Corte irregular de árvore',
                                'Despejos de residuos sólidos',
                                'Denuncia de maus tratos a animais',
                                'Encontro de veiculos abandonados',
                                'Furto a transeunte',
                                'Furto ao comercio',
                                'Invasão ao espaço publico',
                                'Mal súbito em via pública',
                                'Manifestação em via pública',
                                'Manifestação na prefeitura',
                                'Operação de controle de tráfego',
                                'Operações integradas PMERJ / PCERJ',
                                'Pertubação do sossego público',
                                'Resgate a animais selvagens',
                                'Roubo a transeunte',
                                'Vandalismo / Pixação ao patrimônio',
                                'Vias de fato em via pública/praças',
                                'Segurança pública em jogos/estádios',
                                ])                    ->nullable();
            $table->enum('acao_cop',[
                                'Notificação de irregularidades',
                                'Apreensão de material, mercadoria ou equipamento irregular',
                                'Intimação por infração',
                                'Multa por infração',
                                'Ação noturna',
                                'Demolição de construção, equipamento ou material irregular',
                                'Fiscalização de praças',
                                'Serviços especiais (Feriados e afins)',
                                'Retirada de material de propaganda irregular',
                                ])                     ->nullable();
            
            $table->enum('tipo',[
                            'GCMM',
                            'COP',
                                ])                    ->nullable();

            $table->text('relato')                    ->nullable();
            $table->text('providencia')               ->nullable();
            $table->mediumText('foto')                ->nullable();


            //------------------------FOREIGN--------------------------------
            $table->integer('funcionario_id')->unsigned();
            $table->integer('endereco_id')->unsigned();
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
         Schema::dropIfExists('semsop_relatorios');
    }
}
