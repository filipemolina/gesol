<?php

use Illuminate\Database\Seeder;

class SecretariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\Models\Secretaria::class, 3)
           ->create()
           ->each(function ($secretaria) {

           		// Endereço
                $secretaria->endereco()->save(factory(App\Models\Endereco::class)->make());

				// Telefones
                $secretaria->telefones()->saveMany(factory(App\Models\Telefone::class, rand(1,5))->make());                             
            });
    }
}
