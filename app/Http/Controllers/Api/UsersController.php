<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Solicitante;
use App\User;

class UsersController extends Controller
{
    // Receber os dados do usuário do Facebook e retornar um token de acesso ao Gesol

	public function retornaToken(Request $request)
	{
		// Validar os dados

		$this->validate($request, [
			'nome'  => 'required',
			'email' => 'required',
			'token' => 'required',
			'uid'   => 'required',
			'foto'  => 'required',
		]);

		// Obter os dados enviados, incluindo o Token do facebook

		$dados = $request->all();

		// Procurar no banco de dados por um solicitante que possua a UID fornecida

		$solicitante = Solicitante::where('fb_uid', $request->uid)->get();

		if($solicitante->count() < 1)
		{
			// Caso o solicitante não exista, criar um usando nome, email e token do usuário e uma senha aleatória

			$novo_solicitante = Solicitante::create([
				'nome'     => $request->nome,
				'email'    => $request->email,
				'fb_token' => $request->token,
				'fb_uid'   => $request->uid,
				'foto'     => $request->foto
			]);

			// Procurar por um usuário na tabela Users que tenha o email enviardo na request

			$usuario = User::where('email', $request->email)->get();

			if($usuario->count() < 1)
			{
				// Caso o usuário não exista, criar um novo usuário relacionado ao solicitante

				$novo_solicitante->user()->create([
					'email'          => $request->email,
					'password'       => Hash::make(123456)
				]);

			} else {


				// Caso contrário, utilizar o usuário encontrado para relacioar ao solicitante

				$novo_solicitante->user()->save($usuario[0]);

			}

			// Definir a variável para utilizar o solicitante criado

			$solicitante = $novo_solicitante;

		} else {

			// Definir a variável para utilizar o solicitante existente

			$solicitante = $solicitante[0];

		}

		// Criar um token de acesso pessoal

		return $solicitante->user->createToken('Token APP');	
	}

	/**
	 * Validar e criar usuários através da interface do aplicativo
	 */

	public function create(Request $request)
	{

		// Validar os dados

		$this->validate($request, [
			'nome' => 'required',
			'email' => 'required|unique:solicitantes',
			'cpf' => 'required|cpf|unique:solicitantes',
			'senha' => 'required|confirmed|min:6',
		]);

		// Criar um solicitante

		$solicitante = Solicitante::create([
			'cpf' => $request->cpf,
			'nome' => $request->nome,
			'email' => $request->email,
			'foto' => "http://lorempixel.com/200/200/people/",
		]);

		// Procurar por um usuário na tabela Users que tenha o email enviardo na request

		$usuario = User::where('email', $request->email)->get();

		if($usuario->count() < 1){

			// Caso o usuário não exista, criar um novo usuário relacionado ao solicitante

			$solicitante->user()->create([
				'email'          => $request->email,
				'password' => bcrypt($request->senha)
			]);

			return $solicitante->user->createToken('Token App');

		} else {

			// Caso contrário, utilizar o usuário encontrado para relacioar ao solicitante

			$solicitante->user()->save($usuario[0]);

			return $solicitante->user->createToken('Token APP');

		}

	}

	/**
	 * Validar os dados de login do usuário e retornar um token de acesso em caso positivo
	 */

	public function login(Request $request){

		// validação

		$this->validate($request, [
			'email' => 'required|email',
			'senha' => 'required|min:6'
		]);

		// Procurar pelo usuário que esteja cadastrado com esse email

		$solicitante = Solicitante::where('email', $request->email)->first();

		if($solicitante != null){

			// Checar a senha

			if(Hash::check($request->senha, $solicitante->user->password)){

				$resposta = new \stdClass();
				$resposta->foto  = $solicitante->foto;
				$resposta->nome  = $solicitante->nome;
				$resposta->email = $solicitante->email;
				$resposta->token = $solicitante->user->createToken("Token APP");
				$resposta->id    = $solicitante->id;


				return json_encode($resposta);

			}else{

				// Caso a senha esteja errada, criar um objeto de erro e retornar como json

				$resposta = new \stdClass();
				$resposta->senha = ['Senha não confere'];

				return response()->json($resposta,422);

			}

		}
		else
		{
			// Caso o email não seja encontrado, criar um objeto de erro e retornar como json

			$resposta = new \stdClass();
			$resposta->email = ['Este e-mail não está cadastrado no sistema.'];

			return response()->json($resposta, 422);
		}

	}

}
