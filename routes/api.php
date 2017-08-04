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

Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::get("/callback", function(Request $request){

	print_r($request);

});
