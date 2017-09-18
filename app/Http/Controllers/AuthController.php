<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login
     */

    public function login()
    {
        return view('auth.login');
    }

    /**
     * Gerenciar o login quando for enviado via POST
     */

    public function entrar(Request $request)
    {

    	// Obter o usuário 
    	$usuario = User::where('email', $request->email)->first();

    	// Testar a senha
    	if(Hash::check($request->senha, $usuario->password))
    	{
    		// Verificar se o usuário possui um funcionário relacionado
    		if(count($usuario->funcionario))
    		{
    			// Logar o usuário

    			if(Auth::attempt(['email' => $request->email, 'password' => $request->senha]))
    			{
    				// Redirecionar para o Painel Principal

    				return redirect()->intended('/');
    			}
    		}
    		else
    		{
    			echo "Não é um funcionário<br/>";	
    		}

    		echo "<h2>Senha Confere</h2>";
    	} else {
    		echo "<h2>Senha Não Confere</h2>";
    	}


    }
}
