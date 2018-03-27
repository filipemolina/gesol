<?php

use Illuminate\Database\Seeder;
use App\Models\Servico;

class SolicitacaoSeeder extends Seeder
{

	public function run()
	{


		factory(App\Models\Solicitacao::class, 10)->create()->each(function($solicitacao)
		{
			$solicitacao->endereco()->save(factory(App\Models\Endereco::class)->make());
                // Criar comentarios
			$solicitacao->comentarios()->saveMany(factory(App\Models\Comentario::class, rand(1, 2))->make());
		});

	}
}
