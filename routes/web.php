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

Route::get ('/', 				'HomeController@index')->name('home');

//========================================================================================
// 										LOGIN/REGISTRO
//========================================================================================

Route::get ("/login", 		"AuthController@login")->name('login');
Route::post('/login', 		"AuthController@entrar");
Route::get ('/logout', 		'AuthController@logout')->name('logout');

Route::get ('/register', 	function () {return view('solicitantes.create');})->name('register');
Route::get ('/pusher', 		'HomeController@pusher');

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
// 										SERVIÇO	
//========================================================================================
// Rota para preencher o select de secretarias na edição/criação de servicos
Route::get('setoresDaSecretaria', 'ServicoController@setoresDaSecretaria');
Route::post('/MudaStatus_Servico','ServicoController@MudaStatus_Servico');

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
// Rota para preencher o select de cargos na edição/criação de funcionarios
Route::get('cargos','FuncionarioController@cargos');

//========================================================================================
// 										COMUNICADOS
//========================================================================================
// Rota para preencher os comunicados do prefeito
// Rota utilizada pelo gesol para atualizar o número de notificações mostradas na tela
Route::post('naolidas/{setor_id}', 'SolicitacaoController@naoLidas');

// DataTables dos Comunicados
Route::get('comunicado/datatables', 'ComunicadoController@dados');


//========================================================================================
// 										SEMSOP_RELATORIOS
//========================================================================================
// Imprimir PDF
Route::get('semsop/pdf/{id}','Semsop_RelatorioController@imprimir');
// Enviar Formulario
Route::post('semsop/enviaformulario','Semsop_RelatorioController@envia');


//========================================================================================
// 										RESOURCE
//========================================================================================
//resources
Route::resource('solicitante',	   'SolicitanteController');
Route::resource('funcionario',	   'FuncionarioController');
Route::resource('solicitacao',	   'SolicitacaoController');
Route::resource('comunicado',       'ComunicadoController');
Route::resource('comentario',		   'ComentarioController');
Route::resource('secretaria',		   'SecretariaController');
Route::resource('atribuicao',		   'AtribuicaoController');
Route::resource('setor',			   'SetorController');
Route::resource('servico',			   'ServicoController');
Route::resource('semsop',	         'Semsop_RelatorioController');


// Password Reset Routes...
// Route::get ('password/reset', 			'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/email', 			'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get ('password/nova/{token}', 	'Auth\ResetPasswordController@showResetForm');
// Route::post('password/reset', 			'Auth\ResetPasswordController@reset')->name('password.reset');


// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
