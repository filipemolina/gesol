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

Route::get("/login", "AuthController@login")->name('login');
Route::post('/login', "AuthController@entrar");
Route::get('/register', function () {return view('solicitantes.create');});

Route::get('/', 'HomeController@index')->name('home');
// Rota para o dataTables
Route::get('solicitacao/datatables/{liberado}', 'HomeController@dados');

//resources
Route::resource('solicitante','SolicitanteController');
Route::resource('funcionario','FuncionarioController');
Route::resource('solicitacao','SolicitacaoController');
//Route::resource('users', 'UsersController');