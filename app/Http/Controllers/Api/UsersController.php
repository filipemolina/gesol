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

		$solicitante = Solicitante::where('uid', $request->uid)->get();

		if($solicitante->count() < 1)
		{
			// Caso o solicitante não exista, criar um usando nome, email e token do usuário e uma senha aleatória

			$novo_solicitante = Solicitante::create([
				'nome'  => $request->nome,
				'email' => $request->email,
				'token' => $request->token,
				'uid'   => $request->uid,
				'foto'  => $request->foto
			]);

			// Procurar por um usuário na tabela Users que tenha o email enviardo na request

			$usuario = User::where('email', $request->email)->get();

			if($usuario->count() < 1)
			{
				// Caso o usuário não exista, criar um novo usuário relacionado ao solicitante

				$novo_solicitante->user()->create([
					'name'           => $request->nome,
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

}
