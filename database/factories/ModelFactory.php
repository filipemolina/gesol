<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        
        'email' 		=> $faker->unique()->safeEmail,
        'password' 	=> $password ?: $password = bcrypt('secret'),
        'avatar' 		=> $faker->imageUrl(120, 150, 'people', true, 'Faker'),
    ];
});



// ========================================================================================================
// ========================================================================================================
// ========================================================================================================


$factory->define(App\Models\Endereco::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');
	return [

		'uf'				=> $faker->stateAbbr,
		'municipio'	 	=> $faker->city,
		'bairro'			=> $faker->cityPrefix,
		'logradouro'   => $faker->streetName,
		'numero'   		=> $faker->randomNumber(3),
		'complemento'  => $faker->secondaryAddress,
		'cep'          => $faker->randomNumber(5)."-".$faker->randomNumber(3),
		'latitude'		=> $faker->latitude($min  = -22.7741, $max = -22.8000),
		'longitude'		=> $faker->longitude($min = -43.4384, $max = -43.4129)     // 77.147489


	];
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Funcionario::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');
	return [
		'nome'            => $faker->name,
		'matricula'       => $faker->numberBetween($min = 1111, $max = 99999),
		'cpf'           	=> $faker->cpf,
		'cargo'			   => $faker->jobTitle,
		'foto'				=> $faker->imageUrl(120, 150, 'people', true, 'Faker'),
		'acesso'				=> $faker->randomElement(["TI","Prefeito","Ouvidor", "Secretario",
																	"Funcionario","Moderador","Desativado"]),
	];
});


// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Comentario::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');

	// Decidir se a comentario é do solicitante ou do funcionário

	if(rand(0,1)){
		$funcionario_id = App\Models\Funcionario::all()->random()->id;
	} else {
		$funcionario_id = null;
	}


	return [
		'comentario'          => $faker->realText($maxNbChars = 30, $indexSize = 2), 
		'encerramento'      => $faker-> boolean($chanceOfGettingTrue = 90),
		'lida'           	=> $faker-> boolean($chanceOfGettingTrue = 50),

		'funcionario_id'	=> $funcionario_id,

	];
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Secretaria::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');
	return [
		'nome'             		=> $faker->company,
		'secretario'      		=> $faker->name,
		'sigla'      				=> $faker->lexify('SEM????'),
		'email' 						=> $faker->unique()->email,
		'inicio_atendimento'		=> $faker->time('H:i:s','10:00:00'),
		'termino_atendimento'	=> $faker->time('H:i:s','19:00:00'),
	];
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Servico::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');
	return [
		'nome'             		=> $faker->jobTitle,
		'icone'						=> $faker->imageUrl(100, 100, 'abstract', true, 'Faker'),
	];
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Setor::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');
	return [
		'nome'             		=> $faker->jobTitle,
	];
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Solicitacao::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');

	
	$foto = 'data:image/jpg;base64,' . base64_encode(file_get_contents($faker->imageUrl(1024, 768, 'nature', true, 'Faker')));

	return [
		//'foto'					=> $faker->imageUrl(1024, 768, 'nature', true, 'Faker'),
		'foto'					=> $foto,
		
		'moderado'				=>	rand(0, 1),
		'conteudo'          	=> $faker->realText($maxNbChars = 190, $indexSize = 2),
		'status'					=> $faker->randomElement(['Aberta','Em análise','Em execução','Solucionada','Recusada','Encaminhada']),
		'prioridade'			=> $faker->randomElement(['Baixa','Normal','Alta','Urgente']),
		'created_at'         => $faker->dateTimeBetween('-5 weeks', 'now'),

		'servico_id'  			=> App\Models\Servico::all()->random()->id,
		'solicitante_id'		=> App\Models\Solicitante::all()->random()->id,
	];
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Solicitante::class, function(Faker\Generator $faker) {

	$faker = Faker\Factory::create('pt_BR');

	// Consertar a proporção de "outros" no sexo.

	if($faker->boolean(10))
	{
		$sexo = "Outros";
	}
	else
	{
		$sexo = $faker->randomElement(["Masculino", "Feminino"]);
	}

	$mulher_responsavel = false;

	if($sexo == "Feminino" || $sexo == "Outros")
	{
		$mulher_responsavel = $faker->boolean;
	}

	$nascimento = $faker->dateTimeBetween("-90 years", "-18 years")->format('Y-m-d');
	$idoso = false;

	if(date('Y') - date('Y', strtotime($nascimento)) >= 65)
    {
        $idoso = true;
    }

    $necessidades = $faker->boolean(10);


	$nascimento = $faker->dateTimeBetween("-90 years", "-18 years")->format('Y-m-d');


    $necessidades = $faker->boolean(10);

    if($necessidades)

    	$tipo = $faker->randomElement([
			"Microcefalia",
			"Deficiência Física",
			"Deficiência Auditiva",
			"Deficiência Visual",
			"Deficiência Mental",
			"Deficiência Múltipla",
    	]);
    
    else
    	$tipo = null;

 	$foto = 'data:image/jpg;base64,' . base64_encode(file_get_contents($faker->imageUrl(120, 150, 'people', true, 'Faker')));

	return [

		'nome'                 		=> $faker->name,
		'email' 							=> $faker->unique()->email,

		'sexo'                    	=> $sexo,
		
		'fb_uid'               		=> $faker->numerify('#########'),
		'fb_token' 						=> $faker->lexify('??????????????????'),
		'foto'							=> $foto,
		'status'							=> $faker->randomElement(['Criado', 'Ativo','Inativo']),
		'mulher_responsavel'      	=> $mulher_responsavel,
		'renda_familiar'          	=> $faker->randomFloat(2, 800, 9000),
		'tempo_residencia'        	=> $faker->date('Y-m-d', '-1 year'),
		'necessidades_especiais'  	=> $necessidades, // Chance de 10% de sair True
		'tipo_deficiencia'        	=> $tipo,
		'nis'                     	=> $faker->numerify("###.#####.##-#"), // Número de Dígitos
		'ctps'                    	=> $faker->numerify("####### ##-#"),
		'bolsa_familia'           	=> $faker->boolean,
		'vr_bolsa'						=> $faker->randomFloat(2, 80, 200),
		'codigo_inscricao'        	=> $faker->randomNumber(4),
		'cpf'                     	=> $faker->cpf,
		'rg'              		  	=> $faker->rg,
		'emissao_rg'              	=> $faker->date('Y-m-d', '-18 years'),
		'orgao_emissor_rg'        	=> $faker->randomElement(['DETRAN', 'IFP', 'Marinha do Brasil']),
		'rg'                      	=> $faker->rg,
		'titulo_eleitor'          	=> $faker->numerify("########"), // Número de Dígitos 		
		'emissao_titulo'          	=> $faker->date('Y-m-d', '-18 years'),
		'zona_eleitoral'          	=> $faker->randomNumber(4),
		'nascimento'              	=> $nascimento,
		'naturalidade'          	=> $faker->city,
		'nacionalidade'          	=> $faker->country,
		'pai'                 		=> $faker->name,
		'mae'                 		=> $faker->firstNameFemale . $faker->lastname,
		'estado_civil'				=> $faker->randomElement(['Solteiro(a)',
												                'Casado(a)', 
												                'Divorciado(a)',
												                'Viúvo(a)',
												                'Separado(a)',
												                'União estável']),
		
		'profissao'					=> $faker->jobTitle,
		'escolaridade'       		=> $faker->randomElement(['Fundamental - Incompleto','Fundamental - Completo',
																			'Médio - Incompleto','Médio - Completo',
																			'Superior - Incompleto','Superior - Completo',
																			'Pós-graduação - Incompleto','Pós-graduação - Completo',
																			'Mestrado - Incompleto','Mestrado - Completo',
																			'Doutorado - Incompleto','Doutorado - Completo']),
		
		'created_at'              => $faker->dateTimeBetween('-5 weeks', 'now'),
 	];
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Telefone::class, function(Faker\Generator $faker) {

	$faker = Faker\Factory::create('pt_BR');

	if(rand(0,1))
	{
		return [

			'numero'  		=> "(21) ".$faker->cellphone(true, 21),
			'tipo_telefone' => "Celular",

		];	
	}
	else
	{
		return [

			'numero'  		=> "(21) $faker->landline",
			'tipo_telefone' => "Fixo",

		];
	}
});

// ========================================================================================================
// ========================================================================================================
// ========================================================================================================

$factory->define(App\Models\Termo::class, function(Faker\Generator $faker) {
	$faker = Faker\Factory::create('pt_BR');
	return [
		'termo' => $faker->domainWord,
	];
});
