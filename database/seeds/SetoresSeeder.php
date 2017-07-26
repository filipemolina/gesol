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
        $secretarias = Secretaria::all();

        // Iterar por cada secretaria
        foreach($secretarias as $secretaria)
        {

        	// Criar setores para cada secretaria e os serviços relacionados

        	$secretaria->setores()->saveMany( factory(App\Models\Setor::class, rand(1,10))->make() );

        }
    }
}
