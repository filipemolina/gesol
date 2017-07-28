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


Route::middleware('auth')->get('/', function () {
    return view('welcome');
});


Route::get('/register', function () {
    return view('solicitantes.create');
});




//resources
Route::resource('solicitante','SolicitanteController');
Route::resource('funcionario','FuncionarioController');
//Route::resource('users', 'UsersController');

Auth::routes();