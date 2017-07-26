<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitante;
use App\Models\Servico;

class SolicitacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$solicitantes = Solicitante::all();
    	$servicos = Servico::all();

    	echo "Número de Solicitantes:\n";
    	print_r($solicitantes->count());
    	echo "\n";
    	echo "Número de Servicos:\n";
    	print_r($servicos->count());
    	echo "\n";

    	foreach($solicitantes as $solicitante)
    	{

    		echo "Solicitante $solicitante->nome\n";

    		foreach($servicos as $servico)
    		{
    			echo "          Servico $servico->id\n";

    			factory(App\Models\Solicitacao::class)->create([
    				'solicitante_id' => $solicitante->id,
    				'servico_id'     => $servico->id
    			]);

    		}

    	}
    	echo "FINALIZANDO...\n";
    	echo "Número de Solicitantes:\n";
    	print_r($solicitantes->count());
    	echo "\n";
    	echo "Número de Servicos:\n";
    	print_r($servicos->count());
    	echo "\n";
        
    }
}
