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

        // DB::table('setores')->insert(['nome' => 'Iluminação Pública'            ,'secretaria_id' =>    11, 'icone' =>  'mdi-ceiling-light', 'cor' => '#6495ED' ]);
        // DB::table('setores')->insert(['nome' => 'Asfaltamento'                  ,'secretaria_id' =>    11, 'icone' =>  'mdi-road-variant', 'cor' => '#0000CD'  ]);
        // DB::table('setores')->insert(['nome' => 'Esgoto'                        ,'secretaria_id' =>    11, 'icone' =>  'mdi-pipe-disconnected', 'cor' => '#6495ED'  ]);
        // DB::table('setores')->insert(['nome' => 'Limpeza Urbana'                ,'secretaria_id' =>    11, 'icone' =>  'mdi-delete', 'cor' => '#696969'  ]);
        // DB::table('setores')->insert(['nome' => 'Patrimônio Público'            ,'secretaria_id' =>    11, 'icone' =>  'mdi-city', 'cor' => '#8A2BE2'  ]);


        // DB::table('setores')->insert(['nome' => 'Trânsito'                      ,'secretaria_id' =>    15, 'icone' =>  'mdi-car', 'cor' => '#00CED1'  ]);
        // DB::table('setores')->insert(['nome' => 'Semáforo'                      ,'secretaria_id' =>    15, 'icone' =>  'mdi-traffic-light', 'cor' => '#FFA500'  ]);
        // DB::table('setores')->insert(['nome' => 'Estacionamento Irregular'      ,'secretaria_id' =>    15, 'icone' =>  'mdi-car-side', 'cor' => '#A0522D'  ]);
        // DB::table('setores')->insert(['nome' => 'Transporte Público'            ,'secretaria_id' =>    15, 'icone' =>  'mdi-bus-side', 'cor' => '#FF00FF'  ]);
        

        // DB::table('setores')->insert(['nome' => 'Fiscalização'                  ,'secretaria_id' =>    19, 'icone' =>  'mdi-magnify', 'cor' => '#A9A9A9'  ]);
        // DB::table('setores')->insert(['nome' => 'Captura de Abelhas'            ,'secretaria_id' =>    19, 'icone' =>  'mdi-bug', 'cor' => '#FFD700'  ]);

        // DB::table('setores')->insert(['nome' => 'Visita do Agente de Saúde'     ,'secretaria_id' =>    12, 'icone' =>  'mdi-medical-bag', 'cor' => '#FF0000'  ]);

        // DB::table('setores')->insert(['nome' => 'Vigilância Sanitária'          ,'secretaria_id' =>    12, 'icone' =>  'mdi-food-fork-drink', 'cor' => '#1E90FF'  ]);

        // DB::table('setores')->insert(['nome' => 'Benefícios Sociais'            ,'secretaria_id' =>     6, 'icone' =>  'mdi-security-home', 'cor' => '#32CD32'  ]);
        // DB::table('setores')->insert(['nome' => 'Pessoas em Situação de Risco'  ,'secretaria_id' =>     6, 'icone' =>  'mdi-account-multiple', 'cor' => '#CD853F'  ]);

        // DB::table('setores')->insert(['nome' => 'Fiscalização Ambiental'        ,'secretaria_id' =>    10, 'icone' =>  'mdi-nature-people', 'cor' => '#228B22'  ]);
        // DB::table('setores')->insert(['nome' => 'Poda de Árvore'                ,'secretaria_id' =>    10, 'icone' =>  'mdi-tree', 'cor' => '#7CFC00'  ]);

        // DB::table('setores')->insert(['nome' => 'Denúncias'                     ,'secretaria_id' =>    17, 'icone' =>  'mdi-bullhorn', 'cor' => '#FF4500'  ]);

        // DB::table('setores')->insert(['nome' => 'Guarda Municipal'              ,'secretaria_id' =>    13, 'icone' =>  'mdi-security', 'cor' => '#4169E1'  ]);

        // DB::table('setores')->insert(['nome' => 'Desenvolvimento'               ,'secretaria_id' =>    20, 'icone' =>  'mdi-puzzle', 'cor' => '#000000'  ]);
        // DB::table('setores')->insert(['nome' => 'Servidores'                    ,'secretaria_id' =>    20, 'icone' =>  'mdi-server', 'cor' => '#000000'  ]);
        // DB::table('setores')->insert(['nome' => 'Rede'                          ,'secretaria_id' =>    20, 'icone' =>  'mdi-close-network', 'cor' => '#000000'  ]);
        // DB::table('setores')->insert(['nome' => 'Manutenção'                    ,'secretaria_id' =>    20, 'icone' =>  'mdi-mouse-variant', 'cor' => '#000000'  ]);

    }
}
