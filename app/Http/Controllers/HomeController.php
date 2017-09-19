<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Endereco;
use App\Models\User;
use Carbon\Carbon;
use DataTables;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Solicitacao::count() > 0)
        {
            $solicitacoes = Solicitacao::withCount('apoiadores')
                                        ->withCount('comentarios')
                                        ->with('endereco')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);

            return view('welcome', compact('solicitacoes'));
        
        }else{
            dd("Nenhuma solicitação cadastrada");
        }
    }



    public function dados()
    {
        // Obter todos os dados de todos os solicitacoes;

        $solicitacoes = Solicitacao::with('solicitante','servico','servico.setor','endereco')->get();

        // Montar a coleção que irá popular a tabela

        $colecao = collect();

        // Os botões de ação da tabela variam de acordo com o 'role' do usuário atual.

        $acoes = "<a data-title='Visualizar' class='btn btn-cor-padrao  btn-pn-circulo' data-toggle='modal' data-target='#modal_pessoas_show' data-id='{id}' href='#'><i class='fa fa-eye'></i></a>";

        $supervisor_master = "<a title='Visualizar' class='btn btn-cor-padrao  btn-pn-circulo' data-toggle='modal' data-target='#modal_pessoas_show' data-id='{id}' href='#'><i class='fa fa-eye'></i></a><a title='Editar' class='btn btn-cor-padrao  btn-pn-circulo' href='".url("pessoas/{id}/edit")."'><i class='fa fa-pencil'></i></a><a title='Excluir' class='btn btn-cor-perigo btn-excluir btn-pn-circulo'  href='#'' data-nome='{nome}' data-id='{id}'><i class='fa fa-times'></i></a>";

        foreach($solicitacoes as $solicitacao)
        {
            // Preparar a string de ações

            /*if(Auth::user()->admin == "Padrão")
                $acoes = str_replace(['{id}', '{nome}'], [$participante->id, str_replace("'", "'", $participante->nome)], $padrao);
            else
                $acoes = str_replace(['{id}', '{nome}'], [$participante->id, str_replace("'", "'", $participante->nome)], $supervisor_master);*/

            if($solicitacao->moderado)
                $moderado = "Sim";
            else
                $moderado = "Não";

            $colecao->push([
                'foto'      => "<img src='$solicitacao->foto' style='height:60px; width:60px'>",
                'setor'     => $solicitacao->servico->setor->nome,
                'status'    => $solicitacao->status,

                'moderado'  => $moderado,

                
                'abertura'               => \Carbon\Carbon::parse( $solicitacao->created_at)->format('d/m/Y h:m'),
                'acoes'                  => $acoes,
            ]);
        }

        return DataTables::of($colecao)
        ->rawColumns(['foto','acoes'])
        ->make(true);
    }









}
