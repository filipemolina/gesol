<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function __construct(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario; 
        // todas as rotas aqui serão antes autenticadas
        //$this->middleware('auth');
    }
  
    
    public function AlteraSenha()
    {
    	$logado = Auth::user();
    	$guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GCMM');
		$guardagerente = Auth::user()->hasRole('SEMSOP_REL_GERENTE');

        $funcionario = Funcionario::find(Auth::user()->id);
    

        return view('funcionarios.altera_senha',compact('funcionario','logado','guardagcmm','guardagerente'));    
        
    }
    
    public function SalvarSenha(Request $request)
    {
         $logado = Auth::user();
        // Validar
        $this->validate($request, [
            'password_atual'        => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        //dd($request);
        // Obter o usuário
        $funcionario = Funcionario::find(Auth::user()->id);
        // obter a senha atual - será usada para gaurdar no log
        // $senha_atual = bcrypt($request->password_atual);
        //dd($senha_atual);
        if (Hash::check($request->password_atual, $funcionario->password))
        {  

           $funcionario->update(['password' => ($request->password)]);

            return redirect('/')->with('sucesso_alteracao_senha','Senha alterada com sucesso.');
        }else{
            return back()->withErrors('Senha atual não confere');
        }
    }
    
  
 
}