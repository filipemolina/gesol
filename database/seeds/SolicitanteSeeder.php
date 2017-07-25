<?php

use Illuminate\Database\Seeder;


class SolicitanteSeeder extends Seeder
{
    
    public function run()
    {

 		factory(App\Models\Solicitante::class, 50)->create()->each(function($solicitante)
        {
          
           //Criar um endereço
            $solicitante->endereco()->save(factory(App\Models\Endereco::class)->make());
            
          	// Criar 2 telefones
            $solicitante->telefones()->saveMany(factory(App\Models\Telefone::class, 2)->make());
            
            // Criar 1 usuario
            $solicitante->user()->save(factory(App\User::class)->make());

            // Criar solicitações
            //$solicitante->solicitacoes()->saveMany(factory(App\Models\Solicitacao::class, 2)->make());

        });
    }
}
