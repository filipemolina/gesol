<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Comentario;
use App\Models\Movimento;
use App\Models\Parametro;
use App\Models\Endereco;
use App\Models\Setor;
use App\Models\User;
use DataTables;


class ComentarioController extends Controller
{
    public function __construct(Comentario $Comentario)
    {
        $this->Comentario = $Comentario; 
        $this->middleware('auth');
    }
    

    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
        // Validar

        $this->validate($request, [
            'comentario'     => 'required|min:2',
            'solicitacao_id' => 'required'
        ]);

        $comentario = new Comentario($request->all());

        // Associar com uma solicitação e um funcionário

        $comentario->solicitacao_id = $request->solicitacao_id;
        $comentario->funcionario_id = $request->funcionario_id;

        //Salvar

        $comentario->save();

        $resposta                   = new \stdClass();
        $resposta->data             = \Carbon\Carbon::parse( $comentario->created_at)->format('H:i:s -- d/m/Y');
        $resposta->nome_funcionario = $comentario->funcionario->nome;
        $resposta->nome_setor       = $comentario->solicitacao->servico->setor->nome;
        $resposta->sigla            = $comentario->solicitacao->servico->setor->secretaria->sigla;
        $resposta->comentario       = $comentario->comentario;

        return json_encode($resposta);

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $comentario = Comentario::find($id);

        $contador = Comentario::where([
            ['solicitacao_id', $comentario->solicitacao_id],
            ['created_at', '>', $comentario->created_at],
        ])->whereNotNull('funcionario_id')->count();

        if($contador > 0){
            return "0";
        }
        else{
            // $comentario->delete();
            return "1";
        }
    }
}
