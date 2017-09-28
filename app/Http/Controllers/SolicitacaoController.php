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

class SolicitacaoController extends Controller
{
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

        //dd($solicitacao);

        // chama a view de acordo com o tipo de acesso do usuario logado
        switch($funcionario->acesso)
        {
            case "Moderador":
                // Obter todos os setores
                $setores = Setor::with('servicos')->get();

                return view('solicitacoes.edit-moderador', compact('solicitacao','funcionario','setores'));
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

        if(isset($request->servico_id))
        {

            // Gravar o valor antigo do ID do SERVIÇO da solicitação para utilizar na trilha de auditoria
            $valor_antigo = $solicitacao->servico->id;

            //salva na trilha
            trilha($solicitacao->id, 'servico_id', $valor_antigo ,"Redirecionou");

        }elseif (isset($request->comentario)) {
            // Gravar o valor antigo do conteúdo da solicitação para utilizar na trilha de auditoria que o marcelo
            $valor_antigo = $solicitacao->conteudo;

            //salva na trilha
            trilha($solicitacao->id, 'conteudo', $valor_antigo ,"Alterou");

        }

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
