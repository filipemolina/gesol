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



Route::get('/home', 					'HomeController@index')->name('home');
Route::get ('/logout', 					'Auth\LoginController@logout');


<<<<<<< HEAD
//caminho para a tela de alteração de senha
Route::get 	('/alterasenha',			'UserController@AlteraSenha');
Route::post 	('/salvasenha',   		'UserController@SalvarSenha');

//caminho para a tela de alteração do avatar
Route::get 	('/alteraavatar',			'UserController@AlteraAvatar');
Route::put 	('/salvaavatar',   		'UserController@SalvarAvatar');

//caminho para alterar o status do usuario ATIVO/INATIVO
Route::post('/mudastatus',				'UserController@MudaStatus');
=======
Route::middleware('auth')->get('/', function () {
    return view('welcome');
});
>>>>>>> deploy


Route::get('/register', function () {
    return view('solicitantes.create');
});




//resources
Route::resource('solicitante','SolicitanteController');
Route::resource('funcionario','FuncionarioController');
//Route::resource('users', 'UsersController');