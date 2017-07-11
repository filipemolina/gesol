<?php

use Illuminate\Http\Request;
use Socialite;

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

Route::middleware('api')->post("/user", function(Request $request){

	// Obter o usuário do facebook

	$user = Socialite::driver('facebook')->userFromToken($request->token);

	// Procurar no banco de dados por um solicitante que possua a UID fornecida

	// $user->id

	// Caso o usuário não exista, criar um usando nome, email e token do usuário e uma senha aleatória

	// $user->name
	// $user->email
	// $user->token
	// bcrypt(time().name.email.token)

	// Caso o usuário já exista, retornar o username e password

	// return json_encode({ "username" => $user->email, "password" => $user->password })

});

Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});
