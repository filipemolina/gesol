<?php

use Illuminate\Database\Seeder;
use App\Models\Setor;

class ServicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obter todas os setores das secretarias

        /*$setores = Setor::all();

        //Iterar por todos os setores
        foreach($setores as $setor)
        {

        	$setor->servicos()->saveMany( factory(App\Models\Servico::class, rand(1,2))->make() );

            //DB::table('servicos')->insert(['nome'=> 'setor da - ' .$secretaria->sigla ,'secretaria_id' => $secretaria->id ]);
        }*/


            $setor= 1;
            DB::table('servicos')->insert(['nome' => 'Troca de Lâmpadas (Iluminação Pública)'      ,'setor_id' =>$setor ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Novo ponto de Iluminação Pública'             ,'setor_id' =>$setor ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Manutenção do Ponto de Iluminação Pública'   ,'setor_id' =>$setor ,'prazo' =>10 ]);

            $setor= 2;
            DB::table('servicos')->insert(['nome' => 'Buracos Na Rua (pavimentação)'                ,'setor_id' =>$setor ,'prazo' =>10 ]);

            $setor= 3;
            DB::table('servicos')->insert(['nome' => 'Manutenção De Esgoto'                         ,'setor_id' =>$setor ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Manutenção De Bueiros'                        ,'setor_id' =>$setor ,'prazo' =>10 ]);

            $setor= 4;
            DB::table('servicos')->insert(['nome' => 'Retirada De Entulhos'                         ,'setor_id' =>$setor ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Coleta De Lixo'                               ,'setor_id' =>$setor ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Limpeza Urbana'                               ,'setor_id' =>$setor ,'prazo' =>10 ]);

            $setor= 5;
            DB::table('servicos')->insert(['nome' => 'Conservação'                                  ,'setor_id' =>$setor ,'prazo' =>10 ]);

            //================================================================================================================

            $setor= 6;
            DB::table('servicos')->insert(['nome'=>'DeNúncia De Trânsito'                           ,'setor_id' =>$setor  ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome'=>'SoLicitação De Redutor De Velocidade'           ,'setor_id' =>$setor  ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome'=>'SoLicitação De Agente De Trânsito'              ,'setor_id' =>$setor  ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome'=>'SoLitação De Reboque'                           ,'setor_id' =>$setor  ,'prazo' =>10  ]);

            $setor= 7;
            DB::table('servicos')->insert(['nome'=>'Manutenção De Semáforo'                         ,'setor_id' =>$setor  ,'prazo' =>10  ]);

            $setor= 8;
            DB::table('servicos')->insert(['nome'=>'Estacionamento Irregular'                       ,'setor_id' =>$setor  ,'prazo' =>10  ]);

            $setor= 9;
            DB::table('servicos')->insert(['nome'=>'Denúncia Transporte Público Municipal'          ,'setor_id' =>$setor ,'prazo' =>10   ]);

            //==================================================================================================================

            $setor= 10;
            DB::table('servicos')->insert(['nome' => 'Fiscalização Defesa Civil'                    ,'setor_id' =>$setor ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Vistoria De Estrutura'                        ,'setor_id' =>$setor ,'prazo' =>10  ]);

            $setor= 11;
            DB::table('servicos')->insert(['nome' => 'Captura De Abelha'                            ,'setor_id' =>$setor ,'prazo' =>10  ]);

            //=================================================================================================================

            $setor= 12;
            DB::table('servicos')->insert(['nome' => 'Visita Do Agente De Saúde'                    ,'setor_id' =>$setor  ,'prazo' =>10 ]);

            $setor= 13;
            DB::table('servicos')->insert(['nome' => 'Fiscalização Vigilância Sanitária'            ,'setor_id' =>$setor  ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Epidemiológi'                    ,'setor_id' =>$setor ,'prazo' =>10  ]);

            $setor= 14;
            DB::table('servicos')->insert(['nome' => 'Benefícios Sociais'                           ,'setor_id' =>$setor ,'prazo' =>10  ]);

            $setor= 15;
            DB::table('servicos')->insert(['nome' => 'Acolhimento De Pessoas Em Situação De Risco'  ,'setor_id' =>$setor ,'prazo' =>10  ]);

            $setor= 16;
            DB::table('servicos')->insert(['nome' => 'Fiscalização Urbanismo'                       ,'setor_id' =>$setor ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Ambiental/poluição Sonora'       ,'setor_id' =>$setor ,'prazo' =>10  ]);

            $setor= 17;
            DB::table('servicos')->insert(['nome' => 'Poda De Árvore'                               ,'setor_id' =>$setor ,'prazo' =>10  ]);

            $setor= 18;
            DB::table('servicos')->insert(['nome' => 'Denúncia Servidor Municipal'                  ,'setor_id' =>$setor ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Denúncia Prestadora De Serviço'               ,'setor_id' =>$setor ,'prazo' =>10  ]);

            $setor= 19;
            DB::table('servicos')->insert(['nome' => 'Fiscalização Ordem Pública'                   ,'setor_id' =>$setor ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Guarda Municipal'                             ,'setor_id' =>$setor ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Policiamento'                                 ,'setor_id' =>$setor  ,'prazo' =>10 ]);

    }
}
