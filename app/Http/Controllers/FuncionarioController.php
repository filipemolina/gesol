<?php

namespace App\Http\Controllers;


use Mailgun\Mailgun;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Secretaria;
use App\Models\Atribuicao;
use App\Models\Servico;
use App\Models\Setor;
use App\Models\Endereco;
use App\Models\Role;
use App\Models\Cargo;
use App\Models\User;
use Carbon\Carbon;
use DataTables;


class FuncionarioController extends Controller
{

	public function __construct()
	{
	  $this->middleware('auth');

	  $this->middleware('is_Gerir_Usuarios')->only([
		 'index',
		 'edit',
		 'update',
		 'destroy',
		 'create',
		 'store',
	  ]);
	}


	public function index()
	{

	  	// busca o usuario
		  $usuario = User::find(Auth::user()->id);
		  
		// busca o funcionario logado
		$funcionario_logado = $usuario->funcionario;

		
		// busca a secretaria do funcionario logado
		$secretaria_funcionario_logado = $funcionario_logado->setor->secretaria->id;
		
		if($funcionario_logado->role->peso >= 70){
			
			$funcionarios = Funcionario::all();
			
			
		}elseif($funcionario_logado->role->peso >= 30 and $funcionario_logado->role->peso <= 60){
			
			$funcionarios = Funcionario::whereHas('setor', function($q) use ($secretaria_funcionario_logado){
				$q->whereHas('secretaria', function($q2) use ($secretaria_funcionario_logado){
					$q2->where('id', $secretaria_funcionario_logado);
				});
			})->get();
		}
		
		
		

		return view ('funcionarios.index', compact('funcionarios','funcionario_logado'));

	}

	

	public function create()
	{
	  $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

	  //buscas os valores enuns
	  	$roles          = Role::where('peso','<', $funcionario_logado->role->peso)->where('peso','>=', 1)->orderBy('peso', 'asc')->get();
		$secretarias   = DB::table('secretarias')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('setores')
                      ->whereRaw('setores.secretaria_id = secretarias.id');
            })->orderBy('nome')->get();
		  		 
		//  all()->sortBy('nome');
	  	$setores       = Setor::all()->sortBy('nome');        
		$servicos      = Servico::all()->sortBy('nome');       
		$tipos			= pegaValorEnum('funcionarios', 'tipo');
				
		// busca somente as atribuições referentes a secretaria do funcionario que está logado, 
		// e as de peso(role) igual ou menor ao dele
		// se for PREFEITO, TI ou DSV libera todas as atribuições
		if($funcionario_logado->role->peso < 80 )
		{
			$atribuicoes   = DB::table('atribuicoes')
									->where('secretaria_id', 	'=', $funcionario_logado->setor->secretaria->id)
									->where('role_id', 			'<=', $funcionario_logado->role->peso)
									->get();        
		}else{	
			$atribuicoes   = Atribuicao::all()->sortBy('descricao');        
		};

		//retira o "Sistema" do array TIPO  
		unset($tipos[array_search('Sistema', $tipos)]);

	  

	  if ($funcionario_logado->role->peso >= 50) {
		 $pode_alterar_secretaria=1;
	  } else{
		 $pode_alterar_secretaria=0;
	  }
	  //dd($atribuicoes);
	  return view ('funcionarios.create_funcionario',
			compact('funcionario_logado','secretarias','setores',
					 'servicos','roles','pode_alterar_secretaria','tipos','atribuicoes'));
	}

	
	public function store(Request $request)
	{
		
		//dd($request->all());
	  	// busca o usuario
		$usuario = User::find(Auth::user()->id);

		// busca o solicitante
		$funcionario_logado = $usuario->funcionario;

		if($request->has('secretaria_id')){
			$request->merge(['secretaria_id' => $request->select_secretaria]);
		}else{
			$request->merge(['secretaria_id' => $funcionario_logado->setor->secretaria->id]);    
		}

		$this->validate($request, [
			'nome'                  => 'required|max:255',
			'email'                 => 'required|email|max:255|unique:users',
			'cpf'                   => 'cpf|unique:funcionarios',
			'cargo_id'              => 'required',
			'setor_id'              => 'required',
			'role_id'               => 'required',
		]);


		//$funcionario->foto      = $request->foto;
		//$funcionario->setor_id  = $request->foto;

		//dd($funcionario);                

		// Cria um funcionario
		//$funcionario = new Funcionario($request->all());

		$enviar_email       = $request->email;

		$funcionario = new Funcionario;

		$funcionario->nome      = $request->nome;
		$funcionario->cpf       = $request->cpf;
		$funcionario->matricula = $request->matricula;
		$funcionario->cargo_id  = $request->cargo_id;
		$funcionario->setor_id  = $request->setor_id;
		$funcionario->role_id   = $request->role_id;
		$funcionario->foto      = $request->foto;
		$funcionario->tipo   	  = $request->tipo;

		$funcionario->save();

		foreach ($request->atribuicoes as $key => $atribuicao) {
			$funcionario->atribuicoes()->attach($atribuicao);
		}

		$user = new User;
		$user->email        = $request->email;
		$senha_gerada       = str_random(6);
		$user->password     = bcrypt($senha_gerada);



		// Associar user ao funcionario
		$user->funcionario()->associate($funcionario);

		$user->save();


		//salva na trilha
		loga('C', 'USER',           $user->id,          null, null, 'Criou o funcionario ID: '.$funcionario->id);
		loga('C', 'FUNCIONARIO',    $funcionario->id,   null, null, null);

		//dd($enviar_email);

		//envia email com a senha de acesso
		Mail::send('emails.senhafuncionario',[ 'email' => $user->email, 'senha' => $senha_gerada ], function($message) use ($enviar_email){
			$message->to($enviar_email);
			//$message->to('marcelo.miranda.pp@gmail.com');
			$message->subject('Cadastro de usuário no GESOL');
		});

		return redirect(url('/funcionario'))->with('sucesso', 'Funcionario criado com sucesso.');    
	}


	public function show(Funcionario $funcionario)
	{
		$funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

		$roles          = Role::where('peso','<', $funcionario_logado->role->peso)->orderBy('peso', 'asc')->get();
		$secretarias    = Secretaria::all()->sortBy('nome');
		$setores        = Setor::all()->sortBy('nome');        
		$servicos       = Servico::all()->sortBy('nome');        

		

		return view('funcionarios.show', compact('funcionario_logado','funcionario','secretarias','setores','servicos','roles'));
	}

	
	public function edit(Funcionario $funcionario)
	{
	  $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

	  //verifica se o funcionario que está logado tem menos privilégios que o funcionário que ele está alterando
	  if($funcionario_logado->role->peso < $funcionario->role->peso)
	  {
			$roles          = Role::where('peso','=', $funcionario->role->peso)->orderBy('peso', 'asc')->get(); 
	  }else{
			$roles          = Role::where('peso','<=', $funcionario_logado->role->peso)->orderBy('peso', 'asc')->get(); 
	  }

		
		$secretarias   = Secretaria::all()->sortBy('nome');
		$setores       = Setor::all()->sortBy('nome');        
		$servicos      = Servico::all()->sortBy('nome');        
		$tipos			= pegaValorEnum('funcionarios', 'tipo');

		// busca somente as atribuições referentes a secretaria do funcionario que está logado, 
		// e as de peso(role) igual ou menor ao dele
		// se for PREFEITO, TI ou DSV libera todas as atribuições
		if($funcionario_logado->role->peso < 80 )
		{
			$atribuicoes   = DB::table('atribuicoes')
									->where('secretaria_id', 	'=', $funcionario_logado->setor->secretaria->id)
									->where('role_id', 			'<=', $funcionario_logado->role->peso)
									->get();        
		}else{	
			$atribuicoes   = Atribuicao::all()->sortBy('descricao');        
		};

		//retira o "Sistema" do array TIPO  
		unset($tipos[array_search('Sistema', $tipos)]);

		if($funcionario_logado->role->peso >= 50 ) //"Secretario"
		{
			$pode_alterar_secretaria=1;

		}else{
			$pode_alterar_secretaria=0;
		}

		// Vetor que contém apenas os ID's das atribuições deste funcionário
		$atribuicoes_ids = $funcionario->atribuicoes->pluck('id')->toArray();
		// dd($atribuicoes_ids);

		//dd($funcionario->atribuicoes   );
		return view('funcionarios.edit_funcionario', compact('funcionario_logado','funcionario','secretarias','setores','servicos','roles','pode_alterar_secretaria','tipos','atribuicoes', 'atribuicoes_ids'));
	 
	}

	public function update(Request $request, Funcionario $funcionario)
	{

		// busca o usuario da edição
		$usuario = $funcionario->user;    
		
		if($request->has('secretaria_id')){
			$request->merge(['secretaria_id' => $request->select_secretaria]);
		}else{
			$request->merge(['secretaria_id' => $funcionario->setor->secretaria->id]);    
		}

		//dd($request->all());

		$this->validate($request, [
			'nome'                  => 'required|max:255',
			'email'                 => 'required|email|max:255|unique:users,email,'.$funcionario->user->id,
			'cpf'                   => 'cpf|unique:funcionarios,cpf,'.$funcionario->id,
			'matricula'             => 'required',
			'tipo'           		 	=> 'required',
			'cargo_id'              => 'required',
			'secretaria_id'         => 'required',
			'setor_id'              => 'required',
			'role_id'               => 'required',
		]);

		$original_funcionario   = $funcionario->toArray();
		$original_usuario       = $usuario->toArray();
		
		$novo                   = $request->toArray();
		$input                  = $request->all(); 


		$funcionario->fill($input);
		$salvou_funcionario = $funcionario->save();

		$usuario->fill(['email' => $request->email]);
		$salvou_usuario = $usuario->save();
		
		$funcionario->atribuicoes()->sync($request->atribuicoes);
		

		dd($original_funcionario);

		//salva as alterações na trilha de auditoria (sys_logs)
		if($original_usuario['email'] != $novo['email']){
			loga('U', 'USERS', $usuario->id, 'email', $original_usuario['email'], null);
		}


		if($original_funcionario['nome'] != $novo['nome']){
			loga('U', 'FUNCIONARIOS', $funcionario->id, 'nome', $original_funcionario['nome'], null);
		}
	
		if($original_funcionario['foto'] != $novo['foto']){
			loga('U', 'FUNCIONARIOS', $funcionario->id, 'foto', $original_funcionario['foto'], null);
		}
	
		if($original_funcionario['cpf'] != $novo['cpf']){
			loga('U', 'FUNCIONARIOS', $funcionario->id, 'cpf', $original_funcionario['cpf'], null);
		}
	
		if($original_funcionario['matricula'] != $novo['matricula']){
			loga('U', 'FUNCIONARIOS', $funcionario->id, 'matricula', $original_funcionario['matricula'], null);
		}
	
		if($original_funcionario['cargo_id'] != $novo['cargo_id']){
			loga('U', 'FUNCIONARIOS', $funcionario->id, 'cargo_id', $original_funcionario['cargo_id'], null);
		}
	
		if($original_funcionario['setor_id'] != $novo['setor_id']){
			loga('U', 'FUNCIONARIOS', $funcionario->id, 'setor_id', $original_funcionario['setor_id'], null);
		}
	
		if($original_funcionario['role_id'] != $novo['role_id']){
			loga('U', 'FUNCIONARIOS', $funcionario->id, 'role_id', $original_funcionario['role_id'], null);
		}
	
	
		if($salvou_usuario && $salvou_funcionario)
		{ 
			return redirect(url('/funcionario'))->with('sucesso', 'Informações do funcionario alteradas com sucesso.');    
		}else{
			return redirect(url('/funcionario'));    
		}
	}


	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Models\Funcionario  $funcionario
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Funcionario $funcionario)
	{
		//
	}


	/*
	=======================================================================================================
	===============================                  AJAX                    ==============================
	=======================================================================================================
	*/
		
	public function setores(Request $request)
	{
	  $secretaria = Secretaria::with(['setores'])->where('id', $request->secretaria)->first();   
	  return json_encode($secretaria->setores);
	}

	public function cargos(Request $request)
	{
	  $secretaria = Secretaria::with(['cargos'])->where('id', $request->secretaria)->first();   
	  return json_encode($secretaria->cargos);
	}

}
