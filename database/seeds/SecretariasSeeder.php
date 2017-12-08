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
          DB::table('secretarias')->insert(['nome'=>'Gabinete Prefeito'                                                         ,'secretario' => 'Jorge Lúcio Ferreira Miranda'               ,'sigla' => 'GABPRE'        ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Gabinete Vice-Prefeito'                                                    ,'secretario' => 'Walter de Almeida Paixão'                   ,'sigla' => 'GABVICE'       ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Controladoria Geral do Município'                                          ,'secretario' => 'Nicola Fabiano Palmier'                     ,'sigla' => 'CGM'           ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Instituto de Previdência - Mesquitaprev'                                   ,'secretario' => 'Murilo Sanches Rodrigues'                   ,'sigla' => 'PREV'          ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Procuradoria Geral do Município'                                           ,'secretario' => 'Gilmar Brunizi'                             ,'sigla' => 'PGM'           ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Assistência Social'                                ,'secretario' => 'Luiza Cristina Quaresma de Oliveira Va'     ,'sigla' => 'SEMAS'         ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Educação'                                          ,'secretario' => 'Thaís dos Santos de Lima'                   ,'sigla' => 'SEMED'         ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Esporte, Cultura, Lazer e Turismo'                 ,'secretario' => 'Luis Kleber Rodrigues Farias'               ,'sigla' => 'SEMCELT'       ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Fazenda'                                           ,'secretario' => 'Eduardo José Costa de Oliveira'             ,'sigla' => 'SEMEF'         ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Meio Ambiente e Urbanismo'                         ,'secretario' => 'Luney Martins de Almeida'                   ,'sigla' => 'SEMMURB'       ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Obras, Serviços Públicos e Defesa Civil'           ,'secretario' => 'César Marian'                               ,'sigla' => 'SEMOSPDEC'     ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Saúde'                                             ,'secretario' => 'Emerson Trindade da Cost'                   ,'sigla' => 'SEMUS'         ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Segurança, Ordem Pública e Cidadania'              ,'secretario' => 'Sérgio Luis Mendes Afons'                   ,'sigla' => 'SEMSOP'        ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Trabalho, Desenvolvimento Econômico e Agricultura' ,'secretario' => 'Janyr Fernandes de Menezes'                 ,'sigla' => 'SETRADE'       ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Transporte e Trânsito'                             ,'secretario' => 'Fernando Gonzalez dos Santos'               ,'sigla' => 'SETRANS'       ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Secretaria Municipal de Governo, Administração e Planejamento'             ,'secretario' => 'Sergio Renato Ferreira Miranda'             ,'sigla' => 'SEMGAP'        ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal de Administração'                                  ,'secretario' => 'Alexandre Alves Ferraz'                     ,'sigla' => 'SEMGAP'        ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal  Adjunto de Planejamento'                          ,'secretario' => 'Bruno Bondarovsk'                           ,'sigla' => 'SEMGAP'        ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);
          DB::table('secretarias')->insert(['nome'=>'Subsecretaria Municipal de Tecnologia da Informação'                       ,'secretario' => 'Ronald Henrique Ferreira de Almeid'         ,'sigla' => 'STI'           ,'inicio_atendimento' => '09:00:00'  ,'termino_atendimento' => '17:00:00'     ]);





    }
}

