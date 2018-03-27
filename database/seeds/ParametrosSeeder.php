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
   
      DB::table('parametros')->insert(['parametro' => 'motivo-recusa','valor' =>	'Imagem impropria']);
      DB::table('parametros')->insert(['parametro' => 'motivo-recusa','valor' =>	'Solicitação em duplicidade']);
      DB::table('parametros')->insert(['parametro' => 'motivo-recusa','valor' =>	'Não é de resposabilidade da Prefeitura' ]);

      DB::table('parametros')->insert(['parametro' => 'motivo-transferencia','valor' => 'Setor competente errado']);

      DB::table('parametros')->insert(['parametro' => 'motivo-prazo','valor'  =>  'Excesso de demandas no setor' ]);  
      DB::table('parametros')->insert(['parametro' => 'motivo-prazo','valor'  =>  'Sem material' ]);
      DB::table('parametros')->insert(['parametro' => 'motivo-prazo','valor'  =>  'Sem maquinário' ]);
      DB::table('parametros')->insert(['parametro' => 'motivo-prazo','valor'  =>  'Sem pessoal qualificado' ]);
      DB::table('parametros')->insert(['parametro' => 'motivo-prazo','valor'  =>  'Aguardando orgão exterior' ]);
	}
}
