<?php

use Illuminate\Database\Seeder;
use App\Models\Secretaria;

class SetoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Obter todas as secretarias
        //$secretarias = Secretaria::all();

        // Iterar por cada secretaria
        // foreach($secretarias as $secretaria)
        // {

        // 	// Criar setores para cada secretaria e os serviços relacionados

        // 	$secretaria->setores()->saveMany( factory(App\Models\Setor::class, rand(1,10))->make() );

        //     DB::table('setores')->insert(['nome'=> 'setor da - ' .$secretaria->sigla ,'secretaria_id' => $secretaria->id ]);
        // }

        DB::table('setores')->insert(['nome' => 'Iluminação Pública'            ,'secretaria_id' =>    11  ]);
        DB::table('setores')->insert(['nome' => 'Asfaltamento'                  ,'secretaria_id' =>    11  ]);
        DB::table('setores')->insert(['nome' => 'Esgoto'                        ,'secretaria_id' =>    11  ]);
        DB::table('setores')->insert(['nome' => 'Limpeza Urbana'                ,'secretaria_id' =>    11  ]);
        DB::table('setores')->insert(['nome' => 'Patrimônio Público'            ,'secretaria_id' =>    11  ]);


        DB::table('setores')->insert(['nome' => 'Trânsito'                      ,'secretaria_id' =>    15  ]);
        DB::table('setores')->insert(['nome' => 'Semáforo'                      ,'secretaria_id' =>    15  ]);
        DB::table('setores')->insert(['nome' => 'Estacionamento Irregular'      ,'secretaria_id' =>    15  ]);
        DB::table('setores')->insert(['nome' => 'Transporte Público'            ,'secretaria_id' =>    15  ]);
        

        DB::table('setores')->insert(['nome' => 'Fiscalização'                  ,'secretaria_id' =>    19  ]);
        DB::table('setores')->insert(['nome' => 'Captura de Abelhas'            ,'secretaria_id' =>    19  ]);

        DB::table('setores')->insert(['nome' => 'Visita do Agente de Saúde'     ,'secretaria_id' =>    12  ]);

        DB::table('setores')->insert(['nome' => 'Vigilância Sanitária'          ,'secretaria_id' =>    12  ]);

        DB::table('setores')->insert(['nome' => 'Benefícios Sociais'            ,'secretaria_id' =>    6  ]);
        DB::table('setores')->insert(['nome' => 'Pessoas em Situação de Risco'  ,'secretaria_id' =>    6  ]);

        DB::table('setores')->insert(['nome' => 'Fiscalização Ambiental'        ,'secretaria_id' =>    10  ]);
        DB::table('setores')->insert(['nome' => 'Poda de Árvore'                ,'secretaria_id' =>    10  ]);

        DB::table('setores')->insert(['nome' => 'Denúncias'                     ,'secretaria_id' =>    17  ]);


        DB::table('setores')->insert(['nome' => 'Guarda Municipal'              ,'secretaria_id' =>    13  ]);

        

    }
}
