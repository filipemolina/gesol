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
    			return redirect("/login")->withErrors(['erros' => 'Não é um funcionário']); //echo "Não é um funcionário<br/>";	
    		}

    		return redirect("/"); //echo "<h2>Senha Confere</h2>";

    	} else {
            if ($usuario)
            {
                return redirect("/login")->withErrors(['erros' => 'Senha não confere']);
            }else{
                return redirect("/login")->withErrors(['erros' => 'Email não cadastrado']);    
            }
    	}

    }
}
