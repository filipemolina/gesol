<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class SecretariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*       factory(App\Models\Secretaria::class, 3)
           ->create()
           ->each(function ($secretaria) {

            // Endereço
                $secretaria->endereco()->save(factory(App\Models\Endereco::class)->make());
            // Telefones
                $secretaria->telefones()->saveMany(factory(App\Models\Telefone::class, rand(1,5))->make());                             
            });*/

          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Gabinete Prefeito','secretario' => 'Jorge Lúcio Ferreira Miranda','sigla' => 'GABPRE']); 
          //====================================================================================================================================================================
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Gabinete Vice-Prefeito' ,'secretario' => 'Walter de Almeida Paixão' ,'sigla' => 'GABVICE']); 
          //====================================================================================================================================================================
         $secretariaID =  DB::table('secretarias')->insertGetId(['nome'=>'Controladoria Geral do Município'  ,'secretario' => 'Nicola Fabiano Palmier' ,'sigla' => 'CGM']);
          //====================================================================================================================================================================
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Instituto de Previdência - Mesquitaprev' ,'secretario' => 'Murilo Sanches Rodrigues' ,'sigla' => 'PREV']); 
          //====================================================================================================================================================================
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Procuradoria Geral do Município' ,'secretario' => 'Gilmar Brunizi' ,'sigla' => 'PGM']); 
          //====================================================================================================================================================================
          
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Assistência Social','secretario' => 'Luiza Cristina Quaresma de Oliveira ','sigla' => 'SEMAS']);
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Pessoas em Situação de Risco'  ,'secretaria_id' => $secretariaID    , 'icone' =>  'mdi-account-multiple', 'cor' => '#CD853F'  ]);
            DB::table('servicos')->insert(['nome' => 'Acolhimento De Pessoas Em Situação De Risco'  ,'setor_id' => $setorID ,'prazo' =>10  ]);
          
          //====================================================================================================================================================================

          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Educação' ,'secretario' => 'Thaís dos Santos de Lima'  ,'sigla' => 'SEMED']);
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Esporte, Cultura, Lazer e Turismo' ,'secretario' => 'Luis Kleber Rodrigues Farias'  ,'sigla' => 'SEMCELT']);
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Fazenda' ,'secretario' => 'Eduardo José Costa de Oliveira'  ,'sigla' => 'SEMEF']);

          //====================================================================================================================================================================
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Meio Ambiente e Urbanismo','secretario' => 'Luney Martins de Almeida','sigla' => 'SEMMURB']);
          
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Fiscalização Ambiental'        ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-nature-people', 'cor' => '#228B22']);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Urbanismo'                       ,'setor_id' => $setorID ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Ambiental/poluição Sonora'       ,'setor_id' => $setorID ,'prazo' =>10  ]);
          
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Poda de Árvore'                ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-tree', 'cor' => '#7CFC00'  ]);
            DB::table('servicos')->insert(['nome' => 'Poda De Árvore'                               ,'setor_id' => $setorID ,'prazo' =>10  ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Coleta Seletiva'               ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-recycle', 'cor' => '#32CD32'  ]);
            DB::table('servicos')->insert(['nome' => 'Coleta Seletiva'                               ,'setor_id' => $setorID ,'prazo' =>10  ]);


          //====================================================================================================================================================================
          
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Obras, Serviços Públicos e Defesa Civil','secretario' => 'César Marian','sigla' => 'SEMOSPDEC' ]); //11

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Iluminação Pública'            ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-ceiling-light', 'cor' => '#6495ED' ]);
            DB::table('servicos')->insert(['nome' => 'Troca de Lâmpadas (Iluminação Pública)'      ,'setor_id'  =>  $setorID ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Novo ponto de Iluminação Pública'            ,'setor_id'  =>  $setorID ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Manutenção do Ponto de Iluminação Pública'   ,'setor_id'  =>  $setorID ,'prazo' =>10 ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Asfaltamento'                  ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-road-variant', 'cor' => '#0000CD'  ]);
            DB::table('servicos')->insert(['nome' => 'Buracos Na Rua (pavimentação)'                ,'setor_id' => $setorID ,'prazo' =>10 ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Esgoto'                        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-pipe-disconnected', 'cor' => '#6495ED'  ]);
            DB::table('servicos')->insert(['nome' => 'Manutenção De Esgoto'                         ,'setor_id' => $setorID ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Manutenção De Bueiros'                        ,'setor_id' => $setorID ,'prazo' =>10 ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Limpeza Urbana'                ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-delete', 'cor' => '#696969'  ]);
            DB::table('servicos')->insert(['nome' => 'Retirada De Entulhos'                         ,'setor_id' => $setorID ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Coleta De Lixo'                               ,'setor_id' => $setorID ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Limpeza Urbana'                               ,'setor_id' => $setorID ,'prazo' =>10 ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Patrimônio Público'            ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-city', 'cor' => '#8A2BE2'  ]);
            DB::table('servicos')->insert(['nome' => 'Conservação'                                  ,'setor_id' => $setorID ,'prazo' =>10 ]);

          //====================================================================================================================================================================
          
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Saúde','secretario' => 'Emerson Trindade da Costa','sigla' => 'SEMUS'     ]); //12
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Vigilância Sanitária'            ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-food-fork-drink', 'cor' => '#1E90FF'  ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Vigilância Sanitária'            ,'setor_id' => $setorID ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Epidemiológica'                  ,'setor_id' => $setorID ,'prazo' =>10  ]);


          //====================================================================================================================================================================

          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Segurança, Ordem Pública e Cidadania','secretario' => 'Sérgio Luis Mendes Afonso','sigla' => 'SEMSOP'    ]); //13
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Guarda Municipal'              ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-security', 'cor' => '#4169E1'  ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Ordem Pública'                   ,'setor_id' => $setorID ,'prazo' =>10 ]);
            DB::table('servicos')->insert(['nome' => 'Policiamento'                                 ,'setor_id' => $setorID ,'prazo' =>10 ]);

          //====================================================================================================================================================================          
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Trabalho, Desenvolvimento Econômico e Agricultura' ,'secretario' => 'Janyr Fernandes de Menezes' ,'sigla' => 'SETRADE'   ]); //14
          
          //====================================================================================================================================================================            
          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Transporte e Trânsito' ,'secretario' => 'Fernando Gonzalez dos Santos' ,'sigla' => 'SETRANS'   ]); //15
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Trânsito'                      ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-car', 'cor' => '#00CED1'  ]);
            DB::table('servicos')->insert(['nome'=>'Denúncia De Trânsito'                           ,'setor_id' => $setorID  ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome'=>'SoLicitação De Redutor De Velocidade'           ,'setor_id' => $setorID  ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome'=>'SoLicitação De Agente De Trânsito'              ,'setor_id' => $setorID  ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome'=>'SoLitação De Reboque'                           ,'setor_id' => $setorID  ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome'=>'Estacionamento Irregular'                       ,'setor_id' => $setorID  ,'prazo' =>10  ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Semáforo'                      ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-traffic-light', 'cor' => '#FFA500'  ]);
            DB::table('servicos')->insert(['nome'=>'Manutenção De Semáforo'                         ,'setor_id' => $setorID  ,'prazo' =>10  ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Transporte Público'            ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-bus-side', 'cor' => '#FF00FF'  ]);
            DB::table('servicos')->insert(['nome'=>'Denúncia Transporte Público Municipal'          ,'setor_id' => $setorID ,'prazo' =>10   ]);

          //====================================================================================================================================================================            
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Governo, Administração e Planejamento','secretario' => 'Sergio Renato Ferreira Miranda','sigla' => 'SEMGAP'    ]); //16

          //====================================================================================================================================================================  

          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal de Administração','secretario' => 'Alexandre Alves Ferraz' ,'sigla' => 'SEMGAP'    ]); //17

          //====================================================================================================================================================================  

          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal  Adjunto de Planejamento' ,'secretario' => 'Bruno Bondarovsk'  ,'sigla' => 'SEMGAP'    ]); //18

          //====================================================================================================================================================================  

          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Subsecretaria de Defesa Cívil' ,'secretario' => 'Ronaldo Vilazio','sigla' => 'DEFCIV'    ]); //19
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Fiscalização'                  ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-magnify', 'cor' => '#A9A9A9'  ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Defesa Civil'                    ,'setor_id' => $setorID ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Vistoria De Estrutura'                        ,'setor_id' => $setorID ,'prazo' =>10  ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Captura de Abelhas'            ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-bug', 'cor' => '#FFD700'  ]);
            DB::table('servicos')->insert(['nome' => 'Captura De Abelha'                            ,'setor_id' => $setorID ,'prazo' =>10  ]);


          //====================================================================================================================================================================  

          $secretariaID =  DB::table('secretarias')->insertGetId(['nome'=>'Subsecretaria Municipal de Tecnologia da Informação' ,'secretario' => 'Ronald Henrique Ferreira de Almeida'  ,'sigla' => 'STI']); //20
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Desenvolvimento'               ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-puzzle', 'cor' => '#000000'  ]);


          $funcionario = DB::table('funcionarios')->insertGetId([  'nome'      => 'Administrador',
                                              'setor_id'  => $setorID,
                                              'role_id'   => 10,
          ]);
          
          $user = new User;
          $user->email        = 'gesol@mesquita.rj.gov.br';
          $user->password     =  '$2y$10$IV5BxV2wXnW7yswbZPnbd.QJTqUYL2Zkwq972PQXCxOlXfIdIbGUC';
          $user->status       = 'Ativo';
          // Associar user ao funcionario
          $user->funcionario()->associate($funcionario);
          $user->save();


          $setorID = DB::table('setores')->insertGetId(['nome' => 'Servidores'                    ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-server', 'cor' => '#000000'  ]);
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Rede'                          ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-close-network', 'cor' => '#000000'  ]);
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Manutenção'                    ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-mouse-variant', 'cor' => '#000000'  ]);

          





    }
}

