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
      /* $this->call(IconesSeeder::class);
      $this->call(ParametrosSeeder::class);
      $this->call(RolesSeeder::class);
		  $this->call(SecretariasSeeder::class);
      $this->call(AtribuicaoSeeder::class);  
      $this->call(SetoresSaudeSeeder::class);  
        
      //$this->call(FuncionariosSeeder::class);

     for ($s=0; $s < 20; $s++) { 
       echo('solicitante: ' . $s .' - ');
       $this->call(SolicitanteSeeder::class); 
     }
     */
 
     for ($j=0; $j < 100; $j++) { 
       echo('solicitação: ' . $j .' - ');
       $this->call(SolicitacaoSeeder::class);
     }

    
    
    
	}
}

