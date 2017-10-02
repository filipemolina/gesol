<?php

use Illuminate\Database\Seeder;

class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
      DB::table('parametros')->insert(['parametro' => 'motivo'      	,'valor' =>	'Imagem impropria']);
      DB::table('parametros')->insert(['parametro' => 'motivo'      	,'valor' =>	'Solicitação em duplicidade']);
      DB::table('parametros')->insert(['parametro' => 'motivo'   		,'valor' =>	'Não é de resposabilidade da Prefeitura' ]);

	}
}
