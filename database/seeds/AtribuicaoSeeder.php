<?php

use Illuminate\Database\Seeder;

class AtribuicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atribuicoes')->insert(['atribuicao' => 'COMUNICADOR',        'descricao' =>	'Enviar Comunicados']);
        DB::table('atribuicoes')->insert(['atribuicao' => 'REABRIDOR',          'descricao' =>	'Reabrir Solicitações']);
        DB::table('atribuicoes')->insert(['atribuicao' => 'SEMSOP_REL_FISCAL',  'descricao' =>	'Criar Relatorios da SEMSOP como Fiscal de Posturas']);
        DB::table('atribuicoes')->insert(['atribuicao' => 'SEMSOP_REL_GCMM',    'descricao' =>	'Criar Relatorios da SEMSOP como Guarda Civil Municipal']);
        DB::table('atribuicoes')->insert(['atribuicao' => 'SEMSOP_REL_GERENTE',  'descricao' =>	'Gerenciar os Relatorios da SEMSOP']);
    }
}

