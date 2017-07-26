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

        $setores = Setor::all();

        //Iterar por todos os setores
        foreach($setores as $setor)
        {

        	$setor->servicos()->saveMany( factory(App\Models\Servico::class, rand(1,2))->make() );

        }
    }
}
