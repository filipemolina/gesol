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

        $this->middleware('is_Gerir_Usuarios')->only([
            'index',
            'edit',
            'update',
            'destroy',
            'create',
            'store',
            
        ]);

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
        $roles          = Role::where('peso','<', $funcionario_logado->role->peso)->where('peso','>=', 1)
                                ->orderBy('peso', 'asc')->get();

        //dd($roles);
        $secretarias    = Secretaria::all()->sortBy('nome');
        $setores        = Setor::all()->sortBy('nome');        
        $servicos       = Servico::all()->sortBy('nome');        

        if ($funcionario_logado->role->peso >= 50) {
            $pode_alterar_secretaria=1;
        } else{
            $pode_alterar_secretaria=0;
        }


        return view ('funcionarios.create_funcionario',
                        compact('funcionario_logado','secretarias','setores',
                                'servicos','roles','pode_alterar_secretaria'));
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
        $funcionario_logado = $usuario->funcionario;

        if($request->has('secretaria_id')){
            $request->merge(['secretaria_id' => $request->select_secretaria]);
        }else{
            $request->merge(['secretaria_id' => $funcionario_logado->setor->secretaria->id]);    
        }
        
       
        //dd($request->all());

        $this->validate($request, [
            'nome'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'cpf'                   => 'cpf|unique:funcionarios',
            'cargo'                 => 'required',
            'setor_id'              => 'required',
            'role_id'               => 'required',
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
        $funcionario->role_id   = $request->role_id;
        $funcionario->foto      = $request->foto;

        $funcionario->save();

        $user = new User;
        //$user->password = bcrypt($request->password);
        $user->email        = $request->email;
        $user->password     = bcrypt('teste123');
        
        // Associar user ao funcionario
        $user->funcionario()->associate($funcionario);
        
        $user->save();


        //salva na trilha
        loga('C', 'USER',           $user->id,          null, null, 'Criou o funcionario ID: '.$funcionario->id);
        loga('C', 'FUNCIONARIO',    $funcionario->id,   null, null, null);




      
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

        
        if($funcionario_logado->role->peso >= 50 ) //"Secretario"
        {
            $pode_alterar_secretaria=1;

        }else{
            $pode_alterar_secretaria=0;
        }


        return view('funcionarios.edit', compact('funcionario_logado','funcionario','secretarias','setores','servicos','roles','pode_alterar_secretaria'));
     
    }

    public function update(Request $request, Funcionario $funcionario)
    {

        if($request->has('secretaria_id')){
            $request->merge(['secretaria_id' => $request->select_secretaria]);
        }else{
            $request->merge(['secretaria_id' => $funcionario->setor->secretaria->id]);    
        }

        $this->validate($request, [
            'nome'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users,email,'.$funcionario->id,
            'cpf'                   => 'cpf|unique:funcionarios,cpf,'.$funcionario->id,
            'cargo'                 => 'required',
            'secretaria_id'         => 'required',
            'setor_id'              => 'required',
            'matricula'             => 'required',
            'role_id'               => 'required',
        ]);

        $original   = $funcionario;
        $novo       = $request;

        

        // busca o usuario da edição
        $usuario = $funcionario->user;         
        $input   = $request->all(); 

        $funcionario->fill($input);
        $salvou = $funcionario->save();

        
        dd($original->nome , $novo->nome);

        if($original->nome != $novo->nome){
            loga('U', 'FUNCIONARIO',    $original->id, 'NOME', $original->nome, null);
        }



/*        foreach ($request->all() as $key => $value) {
            //if($key != "id" || $key != "created_at" || $key != "updated_at") {

                if($functionario->{$key} != $value){

                    if(is_array($value))
                        $value = $value['id'];

                    echo "{$key}";
                    echo "  ======= ";
                    echo $value;
                    echo "</br>";

                    loga('U', 'FUNCIONARIO',    $funcionario->id, $funcionario->{$key}, $funcionario->{$value}, null);
                }
            //}
        }

        exit;*/


        if($salvou)
        { 
            return redirect(url('/funcionario'))->with('sucesso', 'Informações do funcionario alteradas com sucesso.');    
        }else{
            return redirect(url('/funcionario'));    
        }

        
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
