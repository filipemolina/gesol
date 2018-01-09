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

//========================================================================================
// 										LOGIN/REGISTRO
//========================================================================================

Route::get ("/login", 		"AuthController@login")->name('login');
Route::post('/login', 		"AuthController@entrar");
Route::get ('/logout', 		'AuthController@logout');

Route::get ('/register', 	function () {return view('solicitantes.create');});
Route::get ('/', 				'HomeController@index')->name('home');
Route::get ('/pusher', 'HomeController@pusher');

//caminho para a tela de alteração de senha
Route::get 	('/alterasenha',			'UserController@AlteraSenha');
Route::post	('/salvasenha',   		'UserController@SalvarSenha');

//caminho para a tela de alteração do avatar
Route::get 	('/alteraavatar',			'UserController@AlteraAvatar');
Route::put 	('/salvaavatar',   		'UserController@SalvarAvatar');

//caminho para alterar o status do usuario ATIVO/INATIVO
Route::post('/mudastatus',				'UserController@MudaStatus');


//========================================================================================
// 										EMAIL
//========================================================================================
//caminho para envio de emails
Route::post('/senhafuncionario',			'EmailController@EnviarSenhaFuncionario');
Route::post('/zerarsenhafuncionario',	'EmailController@ZerarSenhaFuncionario');

//========================================================================================
// 										SECRETARIA
//========================================================================================
//caminho para alterar o status da SECRETARIA operante=boolean
Route::post('/mudastatus_secretaria',			'SecretariaController@MudaStatus_Secretaria');

//========================================================================================
// 										SETOR
//========================================================================================
//caminho para alterar o status da SETOR operante=boolean
Route::post('/mudastatus_setor',					'SetorController@MudaStatus_Setor');

//caminho para alterar o status da SETOR operante=boolean
Route::post('/mudavisualizacao_setor',		   'SetorController@MudaVisualizacao_Setor');

//========================================================================================
// 										ICONE
//========================================================================================
// Rota para o dataTables da dashboard
Route::get('icone/dados_datatable', 'IconeController@dados_datatable');

//========================================================================================
// 										SOLICITAÇÃO
//========================================================================================
// Rota para o dataTables da dashboard
Route::get('solicitacao/datatables/{liberado}', 'SolicitacaoController@dados');
// Rota para o controle de moderação
Route::post('modera',									'SolicitacaoController@modera');
// Rota para alteração de status da solicitação
Route::post('status',									'SolicitacaoController@status');
// Rota inserir dados de trilha
Route::post('trilha',									'SolicitacaoController@trilha');
// Rota utilizada pelo gesol para atualizar o número de notificações mostradas na tela
Route::post('naolidas/{setor_id}', 					'SolicitacaoController@naoLidas');

//========================================================================================
// 										FUNCIONARIO
//========================================================================================
// Rota para preencher o select de setores na edição/criação de funcionarios
Route::get('setores','FuncionarioController@setores');

//========================================================================================
// 										COMUNICADOS
//========================================================================================
// Rota para preencher os comunicados do prefeito
// Rota utilizada pelo gesol para atualizar o número de notificações mostradas na tela
Route::post('naolidas/{setor_id}', 'SolicitacaoController@naoLidas');

// DataTables dos Comunicados
Route::get('comunicado/datatables', 'ComunicadoController@dados');


//========================================================================================
// 										RESOURCE
//========================================================================================
//resources
Route::resource('solicitante',	'SolicitanteController');
Route::resource('funcionario',	'FuncionarioController');
Route::resource('solicitacao',	'SolicitacaoController');
Route::resource('comunicado',    'ComunicadoController');
Route::resource('comentario',		'ComentarioController');
Route::resource('secretaria',		'SecretariaController');
Route::resource('setor',			'SetorController');
