<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Solicitante;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Esta função deve ser chamada pelo aplicativo após este ter recebido uma token de acesso
 * do Facebook. Essa token deve ser enviada no parâmetro "token" e será utilizada para verificar
 * se o usuário já existe no banco de dados ou não.
 */

Route::middleware('auth:api')->post("/user", function(Request $request){

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

		// Retonar um JSON com as informações do usuário

		return $novo_solicitante->user->toJson();

	} else {

		// Retornar um JSON com as informações do usuário

		return $solicitante[0]->toJson();

	}

});

Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});
