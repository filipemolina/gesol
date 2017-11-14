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
      
      
      DB::table('roles')->insert(['acesso' => 'Moderador',        'peso' => '10'  ]);
      DB::table('roles')->insert(['acesso' => 'SAC',              'peso' => '20'  ]);
      DB::table('roles')->insert(['acesso' => 'Funcionario',      'peso' => '30'  ]);
      DB::table('roles')->insert(['acesso' => 'Funcionario_SUP',  'peso' => '40'  ]);
      DB::table('roles')->insert(['acesso' => 'Funcionario_ADM',  'peso' => '50'  ]);
      DB::table('roles')->insert(['acesso' => 'Secretario',       'peso' => '60'  ]);
      DB::table('roles')->insert(['acesso' => 'Ouvidor',          'peso' => '70'  ]);
      DB::table('roles')->insert(['acesso' => 'Prefeito',         'peso' => '80'  ]);
      DB::table('roles')->insert(['acesso' => 'TI',               'peso' => '90'  ]);
    	DB::table('roles')->insert(['acesso' => 'DSV',					    'peso' =>	'100'	]);




 	/*"TI","Prefeito","Ouvidor","Secretario","Funcionario_ADM","Funcionario-SUP","Funcionario","SAC","Moderador","Desativado"*/

    }
}
