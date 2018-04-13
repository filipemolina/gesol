<?php

use Illuminate\Database\Seeder;

class AtribuicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("atribuicoes")->insert([  "atribuicao"    => "COMUNICADOR",        
                                            "descricao"     =>	"Enviar Comunicados",
                                            "role_id"       => 8,
                                            "secretaria_id" => 1
                                        ]);

        DB::table("atribuicoes")->insert([  "atribuicao"    => "REABRIDOR",          
                                            "descricao"     =>	"Reabrir Solicitações",
                                            "role_id"       => 9,
                                            "secretaria_id" => 16
                                        ]);

        DB::table("atribuicoes")->insert([  "atribuicao"    => "SEMSOP_REL_FISCAL",  
                                            "descricao"     =>	"Criar Relatorios da SEMSOP como Fiscal de Posturas",
                                            "role_id"       => 5,
                                            "secretaria_id" => 9
                                        ]);

        DB::table("atribuicoes")->insert([  "atribuicao"    => "SEMSOP_REL_GCMM",    
                                            "descricao"     =>	"Criar Relatorios da SEMSOP como Guarda Civil Municipal",
                                            "role_id"       => 5,
                                            "secretaria_id" => 9
                                        ]);

        DB::table("atribuicoes")->insert([  "atribuicao"    => "SEMSOP_REL_GERENTE", 
                                            "descricao"     =>	"Gerenciar os Relatorios da SEMSOP",
                                            "role_id"       => 6,
                                            "secretaria_id" => 9
                                        ]);

        DB::table("atribuicoes")->insert([  "atribuicao"    => "SEMUS_REL",          
                                            "descricao"     =>	"Criar Relatorios da SEMUS",
                                            "role_id"       => 5,
                                            "secretaria_id" => 8
                                        ]);

        DB::table("atribuicoes")->insert([  "atribuicao"    => "SEMUS_REL_GERENTE",  
                                            "descricao"     =>	"Gerenciar os Relatorios da SEMUS",
                                            "role_id"       => 6,
                                            "secretaria_id" => 8
                                        ]);


    }
}

