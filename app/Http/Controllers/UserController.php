<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Solicitante;
use App\Models\funcionario;
use App\Models\User;


class UserController extends Controller
{

    public function __construct(User $user)
    {
        $this->user = $user; 
        // todas as rotas aqui serão antes autenticadas
        //$this->middleware('auth');
    }

  
    public function index()
    {
        // Mostrar a lista de usuários
        $usuarios = User::all();
        return $usuarios;
    }


    
    public function create()
    {

    }

    
    public function store(Request $request)
    {        
        $this->validate($request, [
            'nome'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'cpf'                   => 'cpf|unique:solicitantes',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'aceite'                => 'required'
        ]);

        // Cria um solicitante
        $solicitante = new Solicitante($request->all());
        $solicitante->save();

        $user = User::create($request->all());
        $user->password = bcrypt($request->password);
        
        // Associar user ao solicitante
        $user->solicitante()->associate($solicitante);
        $user->save();

        Auth::loginUsingId($user->id);

        return redirect(url('/'))->with('sucesso', 'Usuário cadastrado com sucesso.');
    }

    public function show($id)
    {
        $user = $this->user->find($id);
        return $user;
    }


    public function edit($id)
    {

        $user = $this->user->find($id); 
        return $user;
    }

    public function update(Request $request, $id)
    {
        
        // Validar
        $this->validate($request, [
            'nome'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users,'.$id,
            'cpf'                   => 'cpf|unique:users,'.$id,
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        // Obter o usuário
        $usuario = User::find($id);

        // Atualizar as informações
        $status = $usuario->update($request->all());

        if ($status) {
            return redirect("/user/$usuario->id/edit")->with('sucesso', 'Informações do usuário atualizadas com sucesso.');
        } else {
            //return redirect(back); 
            return redirect("/user/$usuario->id/edit")->with(['erros' => 'Falha ao editar']);
        }
    }


    public function destroy($id)
    {
        $user=User::find($id);

        $status_delecao=$user->delete();


        if ($status_delecao) {
            return redirect("/user/$usuario->id/edit")->with('sucesso', 'Usuário deletado com sucesso.');
        } else {
            //return redirect(back); 
            return redirect("/user/$usuario->id/edit")->with(['erros' => 'Falha ao deletar o usuário']);
        }
    }


    public function Senha()
    {
        //dd("aqui");
        $usuario = User::find(Auth::user()->id);
        $solicitante = $usuario->solicitante; 
        
        //verifica se o solicitante já possui endereço cadastrado, se não possuir cria 
        if( ! $usuario->solicitante->endereco)
        {
            $solicitante->endereco = new Endereco();
        };

        $fixo       ="";
        $celular    ="";

        foreach($solicitante->telefones as $telefone)
        {
            
            if( $telefone['tipo_telefone'] == 'Fixo' )
            {
                $fixo = $telefone['numero'];
                
            };

            if( $telefone['tipo_telefone'] == 'Celular' )
            {
              $celular = $telefone['numero'];
              
            };
        }

    
        $escolaridades      = pegaValorEnum('solicitantes', 'escolaridade');                                                   
        $estados_civil      = pegaValorEnum('solicitantes', 'estado_civil'); 
        $sexos              = pegaValorEnum('solicitantes', 'sexo'); 
        $ufs                = pegaValorEnum('enderecos',    'uf'); 
        
        
        return view('auth.senha',compact('solicitante','usuario','escolaridades','estados_civil','sexos','ufs','fixo','celular'));
        
    }


    public function AlteraSenha()
    {
        //dd("aqui");
        $usuario = User::find(Auth::user()->id);
        $funcionario    = Funcionario::find(Auth::user()->funcionario_id);

        if($usuario->password = bcrypt($usuario->created_at))
        {
            $senha_padrao = $usuario->created_at;
        }else{
            $senha_padrao = null; 
        }

        return view('funcionarios.altera_senha',compact('usuario','funcionario','senha_padrao'));    

        
    }

    public function SalvarSenha(Request $request)
    {
        
        // Validar
        $this->validate($request, [
            'password_atual'        => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        // Obter o usuário
        $usuario = User::find($request->id);


        if (Hash::check($request->password_atual, $usuario->password))
        {
            $usuario->update(['password' => bcrypt($request->password)]);            
            return redirect('/')->with('sucesso_alteracao_senha','Senha alterada com sucesso.');
        }else{

            return back()->withErrors('Senha atual não confere');
        }

    }


    /* ==================================           AVATAR               =========================*/


     public function AlteraAvatar()
    {
        //dd("aqui");
        $usuario = User::find(Auth::user()->id);
        $funcionario    = Funcionario::find(Auth::user()->funcionario_id);

        return view('funcionarios.altera_avatar',compact('usuario','funcionario'));    
        
    }

    public function salvarAvatar(Request $request)
    {
        
        //dd($request->all());
        // Obter o usuário
        
        $usuario = User::find(Auth::user()->id);

        $usuario->update($request->all());

        return redirect(url('/'))->with('sucesso', 'Avatar alterado com sucesso.');    

    }





}
