<?php

use Illuminate\Database\Seeder;

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
          DB::table('secretarias')->insert(['nome'=>'Gabinete Prefeito'                                                         ,'secretario' => 'Jorge Lúcio Ferreira Miranda'               ,'sigla' => 'GABPRE'    ]); //1
          DB::table('secretarias')->insert(['nome'=>'Gabinete Vice-Prefeito'                                                    ,'secretario' => 'Walter de Almeida Paixão'                   ,'sigla' => 'GABVICE'   ]); //2
          DB::table('secretarias')->insert(['nome'=>'Controladoria Geral do Município'                                          ,'secretario' => 'Nicola Fabiano Palmier'                     ,'sigla' => 'CGM'       ]); //3
          DB::table('secretarias')->insert(['nome'=>'Instituto de Previdência - Mesquitaprev'                                   ,'secretario' => 'Murilo Sanches Rodrigues'                   ,'sigla' => 'PREV'      ]); //4
          DB::table('secretarias')->insert(['nome'=>'Procuradoria Geral do Município'                                           ,'secretario' => 'Gilmar Brunizi'                             ,'sigla' => 'PGM'       ]); //5
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Assistência Social'                                ,'secretario' => 'Luiza Cristina Quaresma de Oliveira '       ,'sigla' => 'SEMAS'     ]); //6
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Educação'                                          ,'secretario' => 'Thaís dos Santos de Lima'                   ,'sigla' => 'SEMED'     ]); //7
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Esporte, Cultura, Lazer e Turismo'                 ,'secretario' => 'Luis Kleber Rodrigues Farias'               ,'sigla' => 'SEMCELT'   ]); //8
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Fazenda'                                           ,'secretario' => 'Eduardo José Costa de Oliveira'             ,'sigla' => 'SEMEF'     ]); //9
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Meio Ambiente e Urbanismo'                         ,'secretario' => 'Luney Martins de Almeida'                   ,'sigla' => 'SEMMURB'   ]); //10
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Obras, Serviços Públicos e Defesa Civil'           ,'secretario' => 'César Marian'                               ,'sigla' => 'SEMOSPDEC' ]); //11
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Saúde'                                             ,'secretario' => 'Emerson Trindade da Cost'                   ,'sigla' => 'SEMUS'     ]); //12
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Segurança, Ordem Pública e Cidadania'              ,'secretario' => 'Sérgio Luis Mendes Afons'                   ,'sigla' => 'SEMSOP'    ]); //13
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Trabalho, Desenvolvimento Econômico e Agricultura' ,'secretario' => 'Janyr Fernandes de Menezes'                 ,'sigla' => 'SETRADE'   ]); //14
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Transporte e Trânsito'                             ,'secretario' => 'Fernando Gonzalez dos Santos'               ,'sigla' => 'SETRANS'   ]); //15
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Governo, Administração e Planejamento'             ,'secretario' => 'Sergio Renato Ferreira Miranda'             ,'sigla' => 'SEMGAP'    ]); //16
          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal de Administração'                                  ,'secretario' => 'Alexandre Alves Ferraz'                     ,'sigla' => 'SEMGAP'    ]); //17
          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal  Adjunto de Planejamento'                          ,'secretario' => 'Bruno Bondarovsk'                           ,'sigla' => 'SEMGAP'    ]); //18
          DB::table('secretarias')->insert(['nome'=>'Subsecretaria de Defesa Cívil'                                             ,'secretario' => 'Ronaldo Vilazio'                            ,'sigla' => 'DEFCIV'    ]); //19
          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal de Tecnologia da Informação'                       ,'secretario' => 'Ronald Henrique Ferreira de Almeida'        ,'sigla' => 'STI'       ]); //20
          





    }
}

