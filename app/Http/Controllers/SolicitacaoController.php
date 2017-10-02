<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Movimento;
use App\Models\Endereco;
use App\Models\Setor;
use App\Models\User;
use DataTables;

class SolicitacaoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('solicitacoes.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //busca o funcionario
        $funcionario    = Funcionario::find(Auth::user()->funcionario_id);

        //busca a solicitação que será editada
        /*$solicitacao = Solicitacao::with('endereco','solicitante','servico','servico.setor')->find($id);*/
        $solicitacao = Solicitacao::find($id);

        $enum = pegaValorEnum('parametros', 'motivo_movimento');

        $motivos = [];

        foreach($enum as $texto){

            $motivos[$texto] = $texto;

        }


        // chama a view de acordo com o tipo de acesso do usuario logado
        switch($funcionario->acesso)
        {
            case "Moderador":
                // Obter todos os setores
                $setores = Setor::with('servicos')->get();

                return view('solicitacoes.edit-moderador', compact('solicitacao','funcionario','setores','motivos'));
                break;

            case "Funcionario":
                return view('solicitacoes.edit-funcionario', compact('solicitacao','funcionario'));
                break;
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * ACAO em request:  
     * 1 = LIBERA a solicitacao
     * 2 = redireciona uma solicitação
     * 3 = edita o CONTEUDO 
     * 4 = recusa solicitação
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
/*        // Validar
        $this->validate($request, [
            'conteudo' => 'required'
        ]);
*/

        // Salvar as alterações

        // Obter a solicitação
        $solicitacao = Solicitacao::find($id);


        switch($request->acao)
        {
            // edita CONTEUDO
            case 2:
                // Gravar o valor antigo do conteúdo da solicitação para utilizar na trilha de auditoria que o marcelo
                $valor_antigo = $solicitacao->conteudo;

                //salva na trilha
                trilha($solicitacao->id, 'conteudo', $valor_antigo ,"Alterou",null);

                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();

                return json_encode("ok");

            //redireciona
            case 3:
                // Gravar o valor antigo do ID do SERVIÇO da solicitação para utilizar na trilha de auditoria
                $valor_antigo = $solicitacao->servico->id;

                //salva na trilha
                trilha($solicitacao->id, 'servico_id', $valor_antigo ,"Redirecionou",null);

                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();

                // Criar um objeto para a resposta
                $solicitacao = Solicitacao::find($id);

                $resposta = new \stdClass();
                $resposta->cor      = $solicitacao->servico->setor->cor;
                $resposta->icone    = $solicitacao->servico->setor->icone;
                $resposta->sigla    = $solicitacao->servico->setor->secretaria->sigla;
                $resposta->servico  = $solicitacao->servico->setor->nome;
                $resposta->setor    = $solicitacao->servico->nome;

                return json_encode($resposta);


            // recusa solicitação
            case 4:
                //salva na trilha
                trilha($solicitacao->id, 'servico_id', null ,'Recusou', $request->motivo);

                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();
                return json_encode($request->motivo);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/


    /**
    * Retorna os dados para montar o datatables
    * @param $liberado int: Determina o tipo de dados ....
    * 0 =  Obter todos os dados de todos os solicitacoes que NÃO estão moderadas / MODERADOR
    * 1 =  Obter todos os dados de todos os solicitacoes que JÁ ESTÃO moderadas
    * 2 =  Obter todos os dados de todos os solicitacoes 
    */
    public function dados($liberado)
    {
        // Obter o usuário atualmente logado
        $usuario = User::find(Auth::user()->id);


        // Os botões de ação da tabela variam de acordo com o 'role' do usuário atual.
        // Aqui  os botões PADRÃO serão criados, de acordo com a role do usuario será
        // atearada no SWITCH abaixo
        $padrao = "  <a href='" .url('solicitacao/{id}/edit')    
                    ."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a><a href='" 
                    .url('solicitacao/{id}')         
                    ."' class='btn btn-simple btn-warning btn-icon edit'><i class='material-icons'>visibility</i></a>";



        //faz a buscas das solicitações de acordo com o filtro selecionado
        switch($liberado)
        {
            case 0:
                // Obter todos os dados de todos os solicitacoes que NÃO estão moderadas / MODERADOR;
                $solicitacoes = Solicitacao::where('moderado','=', $liberado)
                                ->where('status','<>', 'Recusada')
                                ->with('solicitante','servico','servico.setor','endereco')->get();
                // Os botões de ação da tabela variam de acordo com o 'role' do usuário atual.
                $padrao = "  <a href='" .url('solicitacao/{id}/edit')    ."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a>";

                break;

            case 1:
                // Obter todos os dados de todos os solicitacoes que JÁ ESTÃO moderadas;
                $solicitacoes = Solicitacao::where('moderado','=', $liberado)
                                ->where('status','<>', 'Recusada')
                                ->with('solicitante','servico','servico.setor','endereco')->get();
                break;

            case 2:
                // Obter todos os dados de todos os solicitacoes ;
                $solicitacoes = Solicitacao::with('solicitante','servico','servico.setor','endereco')->get();
                break;
        }

        
        // Montar a coleção que irá popular a tabela
        $colecao = collect();

       
        

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
        ->rawColumns(['foto','acoes', 'conteudo'])
        ->make(true);
    }

    

    /*
    =======================================================================================================
    ===============================                  AJAX                    ==============================
    =======================================================================================================
    */



    /**
    * Exacuta as ações do moderador
    * param    $id     int: ID da solicitação
    *           $acao   int: ação que será executada 
    * 1 =  Libera a solicitação
    * 2 =  
    * 3 =  
    */
    public function modera(Request $request)
    {
        // Obter o usuário atualmente logado
        $solicitacao = Solicitacao::find($request->solicitacao_id);

        //executa a ação de acordo com o informado na chamada
        switch($request->acao)
        {
            case 1:
                $solicitacao->moderado = 1;
                $solicitacao->save();

                if (trilha($solicitacao->id, null , null ,"Liberou"))
                {
                    return redirect('/');
                }

                break;

        }
    }
}
