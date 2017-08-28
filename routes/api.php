<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Solicitante;
use App\User;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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

Route::post("/user", "Api\UsersController@retornaToken");
Route::post('/user/create', "Api\UsersController@create");
Route::post('/user/login', "Api\UsersController@login");

Route::get("/solicitacoes/minhas", "Api\SolicitacoesController@minhas");

Route::resource('/solicitacoes', 'Api\SolicitacoesController');
Route::resource('/comentarios', 'Api\ComentariosController');
Route::resource('/setores', 'Api\SetoresController');

Route::get("/callback", function(Request $request){

	print_r($request);

});
