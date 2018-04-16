<?php

use Illuminate\Database\Seeder;
use App\Models\Secretaria;

class SetoresSaudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secretariaID = Secretaria::where('sigla', '=', 'SEMUS')->first()->id; 


        $setorID = DB::table('setores')->insertGetId(['nome' => 'CMS Paraná'        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'ESF Walter Borges'     ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'Farmácia & Laboratório Municipal'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'Laboratório Central de Mesquita'       ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'Policlínica Municipal Celestina José Ricardo Rosa'     ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'PSF Edson Passos'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'PSF Jacutinga'     ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'PSF Maria Cristina'        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'PSF Santo Elias'       ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'PSF Sete Anões'        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'SAMU'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Alto Uruguai'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Banco de Areia'        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS BNH'       ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Coréia'        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Cosmorama'     ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Edson Passos'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS França Leite'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Jorge Campos'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Juscelino'     ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Nossa Senhora Das Graças'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Parque Ludolf'     ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Santa Terezinha'       ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Vila Emil II'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'UBS Vila Norma'        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);
		$setorID = DB::table('setores')->insertGetId(['nome' => 'Unidade de Saúde Dr. Mário Bento'      ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-hospital-building', 'cor' => '#ff1e47'  ]);

    }
}
