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
      $this->call(ParametrosSeeder::class);
         $this->call(RolesSeeder::class);
    	 $this->call(SecretariasSeeder::class);
        
        $this->call(FuncionariosSeeder::class);
        
       $this->call(SolicitanteSeeder::class);
         $this->call(SolicitacaoSeeder::class);
         $this->call(SolicitacaoSeeder::class);

         $this->call(SolicitacaoSeeder::class);
         $this->call(SolicitacaoSeeder::class);

         $this->call(SolicitacaoSeeder::class);
         $this->call(SolicitacaoSeeder::class);

         $this->call(SolicitacaoSeeder::class);
         $this->call(SolicitacaoSeeder::class);

         $this->call(SolicitacaoSeeder::class);
         $this->call(SolicitacaoSeeder::class);
         
         $this->call(SolicitacaoSeeder::class);
         
         

        
    }
}

