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
        //testa se o usuário já está logado e redireciona para a home

        if(Auth::user())
        {
            loga('R', 'USERS', Auth::user()->id, '---','---' , 'Logon');
            return redirect()->intended('/');
        }

        return view('auth.login');
    }

    public function logout()
    {
        loga('R', 'USERS', Auth::user()->id, '---','---' , 'Logoff');
        Auth::logout();
        return redirect("/");
    }
    

    /**
     * Gerenciar o login quando for enviado via POST
     */

    public function entrar(Request $request)
    {

    	// Obter o usuário 
    	$usuario = User::where('email', $request->email)->first();

        //verifica se o email existe na base
        if($usuario)
        { 
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

                        //dd("logou");
                        loga('R', 'USERS', Auth::user()->id, '---','---' , 'Logon');
        				return redirect()->intended('/');
        			}
        		}
        		else
        		{
                    loga('R', 'USERS',  '0', 'EMAIL', $request->email , 'Tentativa de Logon - não é funcionario');
        			return redirect("/login")->withErrors(['erros' => 'Não é um funcionário']); //echo "Não é um funcionário<br/>";	
        		}

        		return redirect("/"); //echo "<h2>Senha Confere</h2>";

        	} else {
                loga('R', 'USERS',  '0', 'EMAIL',$request->email , 'Tentativa de Logon - senha errada');
                return redirect("/login")->withErrors(['erros' => 'Senha não confere']);
        	}
        }else{
            //dd("nao existe");
            loga('R', 'USERS', '0', 'EMAIL',$request->email , 'Tentativa de Logon - email não cadastrado');
            return redirect("/login")->withErrors(['erros' => 'Email não cadastrado']);    
        }
    }
}
