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
use App\Models\User;
use Carbon\Carbon;
use DataTables;

class FuncionarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view ('funcionarios.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ("aqui");
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        $secretarias    = Secretaria::all()->sortBy('nome');
        $setores        = Setor::all()->sortBy('nome');        
        $servicos       = Servico::all()->sortBy('nome');        

        return view('funcionarios.edit', compact('funcionario','secretarias','setores','servicos'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
       //dd($request->all());

/*        $this->validate($request, [
            'nome'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:user,email,'.$id,
            'cpf'                   => 'cpf|unique:funcionarios,cpf,'.$id,
            'cargo'                 => 'required',
            'secretaria'            => 'required',
            'setor'                 => 'required',

        ]);

*/

        // busca o usuario
        $usuario = User::find(Auth::user()->id);



        // busca o solicitante
        $funcionario = $usuario->funcionario;

        //descobre a secretaria selecionada no formulario
        $sec = $request->select_secretaria;

        //pega o nome select do setor de acordo com a secretaria selecionada
        $set = "setor_id_". $sec;

        //seta o valor do SETOR_ID do funcionario com o valor do nome do select que está na variavel $set
        $funcionario->setor_id  = $request->$set;



        //$funcionario->foto      = $request->foto;
        //$funcionario->setor_id  = $request->foto;

        //dd($funcionario);                
        $funcionario->update($request->all());


      
        return redirect(url('/'))->with('sucesso', 'Informações do funcionario alteradas com sucesso.');    

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
   

}
