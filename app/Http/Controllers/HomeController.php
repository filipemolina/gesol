<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
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

        $funcionario    = Funcionario::find(Auth::user()->funcionario_id);
        
        //dd(Auth::user()->funcionario_id);

        if( Solicitacao::count() > 0)
        {
            $solicitacoes = Solicitacao::withCount('apoiadores')
                                        ->withCount('comentarios')
                                        ->with('endereco')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);

            // chama a view de acordo com o tipo de acesso do usuario logado
            switch($funcionario->acesso)
            {
                case "Moderador":
                    return view('dashboard.dash-moderador', compact('solicitacoes','funcionario'));
                    break;

                case "Funcionario":
                    return view('dashboard.dash-funcionario', compact('solicitacoes','funcionario'));
                    break;
            }

        }else{
            dd("Nenhuma solicitação cadastrada");
        }
    }



    public function dados($liberado)
    {
        // Obter o usuário atualmente logado
        $usuario = User::find(Auth::user()->id);


        //faz a buscas das solicitações de acordo com o filtro selecionado
        switch($liberado)
        {
            case 0:
                // Obter todos os dados de todos os solicitacoes que NÃO estão moderadas;
                $solicitacoes = Solicitacao::where('moderado','=', $liberado)
                                ->with('solicitante','servico','servico.setor','endereco')->get();
                break;

            case 1:
                // Obter todos os dados de todos os solicitacoes que JÁ ESTÃO moderadas;
                $solicitacoes = Solicitacao::where('moderado','=', $liberado)
                                ->with('solicitante','servico','servico.setor','endereco')->get();
                break;

            case 2:
                // Obter todos os dados de todos os solicitacoes ;
                $solicitacoes = Solicitacao::with('solicitante','servico','servico.setor','endereco')->get();
                break;
        }

        
        // Montar a coleção que irá popular a tabela
        $colecao = collect();

        // Os botões de ação da tabela variam de acordo com o 'role' do usuário atual.
        $padrao = "  <a href='" .url('solicitacao/{id}/edit')    ."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a>
                    <a href='" .url('solicitacao/{id}')         ."' class='btn btn-simple btn-warning btn-icon edit'><i class='material-icons'>visibility</i></a>";

        

        foreach($solicitacoes as $solicitacao)
        {
            // Preparar a string de ações
            $acoes = str_replace(['{id}'], [$solicitacao->id], $padrao);
            /*if(Auth::user()->admin == "Padrão")
                $acoes = str_replace(['{id}', '{nome}'], [$participante->id, str_replace("'", "'", $participante->nome)], $padrao);
            else
                $acoes = str_replace(['{id}', '{nome}'], [$participante->id, str_replace("'", "'", $participante->nome)], $supervisor_master);*/

            if($solicitacao->moderado)
                $moderado = "Sim";
            else
                $moderado = "Não";

            if($solicitacao->servico->setor->secretaria->id == $usuario->funcionario->setor->secretaria->id)
            { 

                $colecao->push([
                    'foto'          => "<img src='$solicitacao->foto' style='height:60px; width:60px'>",
                    'conteudo'      => $solicitacao->conteudo, 
                    'servico'       => $solicitacao->servico->nome,
                    'status'        => $solicitacao->status,
                    'moderado'      => $moderado,
                    'abertura'      => \Carbon\Carbon::parse( $solicitacao->created_at)->format('d/m/Y h:m'),
                    'acoes'         => $acoes,
                ]);
            }
        }

        return DataTables::of($colecao)
        ->rawColumns(['foto','acoes'])
        ->make(true);
    }









}
