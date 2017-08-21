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
            DB::table('servicos')->insert(['nome' => 'TROCA DE LÂMPADAS ( ILUMINAÇÃO PÚBLICA)'      ,'setor_id' =>$setor ]);
            DB::table('servicos')->insert(['nome' => 'NOVO PONTO DE ILUMINAÇÃO PÚBLICA'             ,'setor_id' =>$setor ]);
            DB::table('servicos')->insert(['nome' => 'MANUTENÇÃO DO PONTO DE ILUMINAÇÃO PÚBLICA'    ,'setor_id' =>$setor ]);

            $setor= 2;
            DB::table('servicos')->insert(['nome' => 'BURACOS NA RUA (PAVIMENTAÇÃO)'                ,'setor_id' =>$setor ]);

            $setor= 3;
            DB::table('servicos')->insert(['nome' => 'MANUTENÇÃO DE ESGOTO'                         ,'setor_id' =>$setor ]);
            DB::table('servicos')->insert(['nome' => 'MANUTENÇÃO DE BUEIROS'                        ,'setor_id' =>$setor ]);

            $setor= 4;
            DB::table('servicos')->insert(['nome' => 'RETIRADA DE ENTULHOS'                         ,'setor_id' =>$setor ]);
            DB::table('servicos')->insert(['nome' => 'COLETA DE LIXO'                               ,'setor_id' =>$setor ]);
            DB::table('servicos')->insert(['nome' => 'LIMPEZA URBANA'                               ,'setor_id' =>$setor ]);

            $setor= 5;
            DB::table('servicos')->insert(['nome' => 'CONSERVAÇÃO'                                  ,'setor_id' =>$setor ]);

            //================================================================================================================

            $setor= 6;
            DB::table('servicos')->insert(['nome'=>'DENÚNCIA DE TRÂNSITO'                           ,'setor_id' =>$setor   ]);
            DB::table('servicos')->insert(['nome'=>'SOLICITAÇÃO DE REDUTOR DE VELOCIDADE'           ,'setor_id' =>$setor   ]);
            DB::table('servicos')->insert(['nome'=>'SOLICITAÇÃO DE AGENTE DE TRÂNSITO'              ,'setor_id' =>$setor   ]);
            DB::table('servicos')->insert(['nome'=>'SOLITAÇÃO DE REBOQUE'                           ,'setor_id' =>$setor   ]);

            $setor= 7;
            DB::table('servicos')->insert(['nome'=>'MANUTENÇÃO DE SEMÁFORO'                         ,'setor_id' =>$setor   ]);

            $setor= 8;
            DB::table('servicos')->insert(['nome'=>'ESTACIONAMENTO IRREGULAR'                       ,'setor_id' =>$setor   ]);

            $setor= 9;
            DB::table('servicos')->insert(['nome'=>'DENÚNCIA TRANSPORTE PÚBLICO MUNICIPAL'          ,'setor_id' =>$setor   ]);

            //==================================================================================================================

            $setor= 10;
            DB::table('servicos')->insert(['nome' => 'FISCALIZAÇÃO DEFESA CIVIL'                    ,'setor_id' =>$setor  ]);
            DB::table('servicos')->insert(['nome' => 'VISTORIA DE ESTRUTURA'                        ,'setor_id' =>$setor  ]);

            $setor= 11;
            DB::table('servicos')->insert(['nome' => 'CAPTURA DE ABELHA'                            ,'setor_id' =>$setor  ]);

            //=================================================================================================================

            $setor= 12;
            DB::table('servicos')->insert(['nome' => 'VISITA DO AGENTE DE SAÚDE'                    ,'setor_id' =>$setor  ]);

            $setor= 13;
            DB::table('servicos')->insert(['nome' => 'FISCALIZAÇÃO VIGILÂNCIA SANITÁRIA'            ,'setor_id' =>$setor  ]);
            DB::table('servicos')->insert(['nome' => 'FISCALIZAÇÃO EPIDEMIOLÓGI'                    ,'setor_id' =>$setor  ]);

            $setor= 14;
            DB::table('servicos')->insert(['nome' => 'BENEFÍCIOS SOCIAIS'                           ,'setor_id' =>$setor  ]);

            $setor= 15;
            DB::table('servicos')->insert(['nome' => 'ACOLHIMENTO DE PESSOAS EM SITUAÇÃO DE RISCO'  ,'setor_id' =>$setor  ]);

            $setor= 16;
            DB::table('servicos')->insert(['nome' => 'FISCALIZAÇÃO URBANISMO'                       ,'setor_id' =>$setor  ]);
            DB::table('servicos')->insert(['nome' => 'FISCALIZAÇÃO AMBIENTAL/POLUIÇÃO SONORA'       ,'setor_id' =>$setor  ]);

            $setor= 17;
            DB::table('servicos')->insert(['nome' => 'PODA DE ÁRVORE'                               ,'setor_id' =>$setor  ]);

            $setor= 18;
            DB::table('servicos')->insert(['nome' => 'DENÚNCIA SERVIDOR MUNICIPAL'                  ,'setor_id' =>$setor  ]);
            DB::table('servicos')->insert(['nome' => 'DENÚNCIA PRESTADORA DE SERVIÇO'               ,'setor_id' =>$setor  ]);

            $setor= 19;
            DB::table('servicos')->insert(['nome' => 'FISCALIZAÇÃO ORDEM PÚBLICA'                   ,'setor_id' =>$setor  ]);
            DB::table('servicos')->insert(['nome' => 'GUARDA MUNICIPAL  '                           ,'setor_id' =>$setor  ]);
            DB::table('servicos')->insert(['nome' => 'POLICIAMENTO  '                               ,'setor_id' =>$setor  ]);

    }
}
