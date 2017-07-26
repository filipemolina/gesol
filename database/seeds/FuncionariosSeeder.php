<?php

use Illuminate\Database\Seeder;
use App\Models\Secretaria;

class FuncionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obter todas as secretarias

        $secretarias = Secretaria::all();

        foreach($secretarias as $secretaria)
        {

        	factory(App\Models\Funcionario::class, rand(1,10))
        		->create([ 'secretaria_id' => $secretaria->id ])
        		->each(function($funcionario){

        			$funcionario->user()->save(factory(App\User::class)->make());

        		});

        }
    }
}
