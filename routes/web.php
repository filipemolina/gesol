<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Login e Registro

Route::get ("/login", 		"AuthController@login")->name('login');
Route::post('/login', 		"AuthController@entrar");
Route::get ('/logout', 		'AuthController@logout');
Route::get ('/register', 	function () {return view('solicitantes.create');});
Route::get ('/', 				'HomeController@index')->name('home');

//caminho para a tela de alteração de senha
Route::get 	('/alterasenha',			'UserController@AlteraSenha');
Route::put 	('/salvasenha',   		'UserController@SalvarSenha');

//caminho para a tela de alteração do avatar
Route::get 	('/alteraavatar',			'UserController@AlteraAvatar');
Route::put 	('/salvaavatar',   		'UserController@SalvarAvatar');


// Rota para o dataTables da dashboard
Route::get('solicitacao/datatables/{liberado}', 'SolicitacaoController@dados');

// Rota para o controle de moderação
Route::post('modera',				'SolicitacaoController@modera');

// Rota para alteração de status da solicitação
Route::post('status',				'SolicitacaoController@status');

// Rota inserir dados de trilha
Route::post('trilha',				'SolicitacaoController@trilha');

//resources
Route::resource('solicitante',	'SolicitanteController');
Route::resource('funcionario',	'FuncionarioController');
Route::resource('solicitacao',	'SolicitacaoController');
Route::resource('comentario',		'ComentarioController');
