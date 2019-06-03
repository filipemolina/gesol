<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use Auth;

class AuthController extends Controller
{
    /**
     * Login
     */

    public function login()
    {
      
        return view('auth.login');
    }

    public function entrar(Request $request)
    {
        $credentials = ['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($credentials)){
            $usuario_logado = Auth::user();
            //dd($usuario_logado);
            $retorno = DB::connection('mysql2')->select("select consulta_role($usuario_logado->id , 'GESOL', 'SEMSOP_REL_GCMM') as retorno");
            if($retorno[0]->retorno){
                //dd($retorno[0]->retorno);
                return redirect()->intended('/');
            }else{
                return redirect()->back()->with('msg','Voce não tem acesso ao sistema');
            }
        }else{
            return redirect()->back()->with('msg','Acesso Negado, Email ou senha invalida');
        }
        
    }

    public function logout()
    {  
        Auth::logout();
        return redirect("/");
    }


}