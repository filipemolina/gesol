<?php

use Illuminate\Database\Seeder;
use App\Models\Setor;

class FuncionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obter todas as setores

        $setores = Setor::all();

        foreach($setores as $setor)
        {

        	factory(App\Models\Funcionario::class, rand(1,10))
        		->create([ 'setor_id' => $setor->id ])
        		->each(function($funcionario){

        			$funcionario->user()->save(factory(App\User::class)->make());

        		});

        }
    }
}
