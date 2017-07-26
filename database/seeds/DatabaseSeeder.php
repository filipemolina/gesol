<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(SecretariasSeeder::class);
        $this->call(SetoresSeeder::class);
        $this->call(ServicosSeeder::class);
        $this->call(FuncionariosSeeder::class);
        $this->call(SolicitanteSeeder::class);
       // $this->call(SolicitacoesSeeder::class);
    }
}
