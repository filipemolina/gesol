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

Route::post('/apoiar', "Api\ApoiosController@apoiar");
Route::post('/user/login', "Api\UsersController@login");
Route::post("/user", "Api\UsersController@retornaToken");
Route::post('/user/create', "Api\UsersController@create");
Route::post('/servicosporsetor', "Api\ServicosController@servicosPorSetor");
Route::post('/alteraFcmId', "Api\SolicitantesController@alteraFcmId");

Route::get('/enum/{tabela}/{coluna}', "Api\SolicitantesController@pegaValorEnum");
Route::get("/solicitacoes/minhas", "Api\SolicitacoesController@minhas");
Route::get("/versao", "Api\HomeController@versao");

// Notificações
Route::post("/notificacoes/enviar", "Api\NotificacoesController@enviaNotificacao");

Route::resource('/solicitacoes', 'Api\SolicitacoesController');
Route::resource('/solicitantes', 'Api\SolicitantesController');
Route::resource('/comentarios',  'Api\ComentariosController');
Route::resource('/setores',      'Api\SetoresController');
Route::resource('/tokens',       'Api\TokensController');
Route::resource('/comunicados',  'Api\ComunicadosController');
