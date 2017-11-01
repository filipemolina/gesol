<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Secretaria;
use App\Models\Servico;
use App\Models\Setor;
use App\Models\Endereco;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use DataTables;

class FuncionarioController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');

       /* $this->middleware('is_Gerir_Usuarios')->only([
            'index',
            'edit',
            'update',
            'destroy',
            'create',
            'store',
            
        ]);*/

    }


    public function index()
    {
        //dd("chegou");
         // busca o usuario
        $usuario = User::find(Auth::user()->id);

        // busca o funcionario logado
        $funcionario_logado = $usuario->funcionario;

        // busca a secretaria do funcionario logado
        $secretaria_funcionario_logado = $funcionario_logado->setor->secretaria->id;


        if($funcionario_logado->role->peso >= 70){

            $funcionarios = Funcionario::all();

        }elseif($funcionario_logado->role->peso >= 30 and $funcionario_logado->role->peso <= 50){

            $funcionarios = Funcionario::whereHas('setor', function($q) use ($secretaria_funcionario_logado){
                $q->whereHas('secretaria', function($q2) use ($secretaria_funcionario_logado){
                    $q2->where('id', $secretaria_funcionario_logado);
                });
            })->get();
        }


        return view ('funcionarios.index', compact('funcionario_logado','funcionarios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

        //buscas os valores enuns
        $roles =  pegaValorEnum('funcionarios','role') ;


        $secretarias    = Secretaria::all()->sortBy('nome');
        $setores        = Setor::all()->sortBy('nome');        
        $servicos       = Servico::all()->sortBy('nome');        


        //entrada das roles para a subtração de acordo com o perfil de quem está logado
        $input = $roles;

        if ($funcionario_logado->role == 'Adm Sistema') {
            $pode_alterar_secretaria=1;
            $remover = array("Adm Sistema");

        } elseif ($funcionario_logado->role =='Adm Secretaria') {
            $pode_alterar_secretaria=0;
            $remover = array("Adm Sistema",'Adm Secretaria');

        } elseif ($funcionario_logado->role =='Gerir Usuarios') {
            $pode_alterar_secretaria=0;
            $remover = array("Adm Sistema",'Adm Secretaria','Gerir Usuarios');

        }

        $roles = array_diff($input, $remover);

        return view ('funcionarios.create_funcionario',
                        compact('funcionario_logado','secretarias','setores','servicos','roles','pode_alterar_secretaria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // busca o usuario
        $usuario = User::find(Auth::user()->id);

        // busca o solicitante
        $funcionario = $usuario->funcionario;


        //descobre qual o select de setor está preenchidode acordo com a secretaria e coloca o valor no request->setor_id
        foreach ($request->all() as $campo => $valor) {
            if(substr($campo,-2) == $request->secretaria_id)
            {
                $request->merge(['setor_id' => $valor]);
            }
        }

        
        //dd($request->all());
        

        $this->validate($request, [
            'nome'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'cpf'                   => 'cpf|unique:funcionarios',
            'cargo'                 => 'required',
            'secretaria_id'         => 'required',
            'setor_id'              => 'required',
        ]);





        //$funcionario->foto      = $request->foto;
        //$funcionario->setor_id  = $request->foto;

        //dd($funcionario);                

        // Cria um funcionario
        //$funcionario = new Funcionario($request->all());

        $funcionario = new Funcionario;

        $funcionario->nome      = $request->nome;
        $funcionario->cpf       = $request->cpf;
        $funcionario->matricula = $request->matricula;
        $funcionario->cargo     = $request->cargo;
        $funcionario->setor_id  = $request->setor_id;
        $funcionario->role      = $request->role;
        $funcionario->foto      = $request->foto;

        $funcionario->save();

        $user = new User;
        //$user->password = bcrypt($request->password);
        $user->email        = $request->email;
        $user->password     = bcrypt('teste123');
        
        // Associar user ao funcionario
        $user->funcionario()->associate($funcionario);
        $user->save();


      
        return redirect(url('/funcionario'))->with('sucesso', 'Funcionario criado com sucesso.');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    
    public function edit(Funcionario $funcionario)
    {
        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

        $roles          = Role::where('peso','<', $funcionario_logado->role->peso)->orderBy('peso', 'asc')->get();
        $secretarias    = Secretaria::all()->sortBy('nome');
        $setores        = Setor::all()->sortBy('nome');        
        $servicos       = Servico::all()->sortBy('nome');        

        
        if($funcionario_logado->role->peso >= 60 ) //"Secretario"
        {
            $pode_alterar_secretaria=1;

        }else{
            $pode_alterar_secretaria=0;
        }


        return view('funcionarios.edit', compact('funcionario_logado','funcionario','secretarias','setores','servicos','roles','pode_alterar_secretaria'));
     
    }

    public function update(Request $request, Funcionario $funcionario)
    {
       //descobre qual o select de setor está preenchidode acordo com a secretaria e coloca o valor no request->setor_id
        foreach ($request->all() as $campo => $valor) {
            if(substr($campo,-2) == $request->secretaria_id)
            {
                $request->merge(['setor_id' => $valor]);
            }
        }

        $this->validate($request, [
            'nome'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users,email,'.$funcionario->id,
            'cpf'                   => 'cpf|unique:funcionarios,cpf,'.$funcionario->id,
            'cargo'                 => 'required',
            'secretaria'            => 'required',
            'setor_id'              => 'required',
            'matricula'             => 'required',
            'role_id'               => 'required',

        ]);



        // busca o usuario da edição
        $usuario = $funcionario->user;

        //dd($usuario->email);

        //descobre a secretaria selecionada no formulario
        $sec = $request->select_secretaria;

/*        //pega o nome select do setor de acordo com a secretaria selecionada
        $set = "setor_id_". $sec;

        //seta o valor do SETOR_ID do funcionario com o valor do nome do select que está na variavel $set
        $funcionario->setor_id  = $request->$set;
*/        $funcionario->foto      = $request->foto;
        
        //dd($request->all());                
        $funcionario->fill($request->all());

        return redirect(url('/funcionario'))->with('sucesso', 'Informações do funcionario alteradas com sucesso.');    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }


    /*
    =======================================================================================================
    ===============================                  AJAX                    ==============================
    =======================================================================================================
    */


    public function setor(Request $request)
    {
        $secretaria = Secretaria::with(['setores'])->where('id', $request->secretaria)->first();   

        return json_encode($secretaria->setores);
    }

}
