<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      
      DB::table('roles')->insert(['acesso' => 'Moderador',                            'peso' => '10'  ]);
      DB::table('roles')->insert(['acesso' => 'SAC',                                  'peso' => '20'  ]);
      DB::table('roles')->insert(['acesso' => 'Funcionário',                          'peso' => '30'  ]);
      DB::table('roles')->insert(['acesso' => 'Funcionário Responsável Setor',        'peso' => '40'  ]);
      DB::table('roles')->insert(['acesso' => 'Funcionário Responsável Secretaria',   'peso' => '50'  ]);
      DB::table('roles')->insert(['acesso' => 'Secretario',                           'peso' => '60'  ]);
      DB::table('roles')->insert(['acesso' => 'Secretário',                           'peso' => '70'  ]);
      DB::table('roles')->insert(['acesso' => 'Prefeito',                             'peso' => '80'  ]);
      DB::table('roles')->insert(['acesso' => 'TI',                                   'peso' => '90'  ]);
    	DB::table('roles')->insert(['acesso' => 'DSV',					                        'peso' =>	'100'	]);



    }
}
