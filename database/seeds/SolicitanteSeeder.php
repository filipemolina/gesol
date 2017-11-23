<?php

use Illuminate\Database\Seeder;
use App\Models\Servico;

class SolicitanteSeeder extends Seeder
{
    
    public function run()
    {

 		factory(App\Models\Solicitante::class, 50)->create()->each(function($solicitante)
        {
            // Obter todos os serviços

            $servicos = Servico::all();
          
           //Criar um endereço
            $solicitante->endereco()->save(factory(App\Models\Endereco::class)->make());
            
          	// Criar 2 telefones
            $solicitante->telefones()->saveMany(factory(App\Models\Telefone::class, 1)->make());
            
            // Criar 1 usuario
            $solicitante->user()->save(factory(App\User::class)->make());

           /* // Criar solicitacoes
            $solicitante->solicitacoes()->saveMany(factory(App\Models\Solicitacao::class, rand(1,5))->make());*/

            factory(App\Models\Solicitacao::class, rand(10,20))->create()->each(function($solicitacao)
            {
                $solicitacao->endereco()->save(factory(App\Models\Endereco::class)->make());
                // Criar comentarios
                $solicitacao->comentarios()->saveMany(factory(App\Models\Comentario::class, rand(1, 5))->make());
            });
        });
    }
}
