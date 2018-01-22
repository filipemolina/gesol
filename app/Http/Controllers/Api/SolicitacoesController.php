<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Endereco;
use App\Models\FCM_Token;

class SolicitacoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	// Pular X solicitações
    	$offset = isset($request->offset) ? $request->offset : 0;

        $Solicitacoes = Solicitacao::with([
            'solicitante',
            'comentarios',
            'comentarios.funcionario',
            'comentarios.funcionario.setor.secretaria',
            'servico',
            "servico.setor",
            'servico.setor.secretaria',
            'apoiadores'
        ])->where('moderado', '1')->where('status', '<>', 'Recusada')->withCount('apoiadores')->orderBy('updated_at', 'desc')->skip($offset)->limit(10)->get();

        return $Solicitacoes->toJson();
    }

    /**
     * Show the form for creating a new resource.

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
        // Validar a requisição
        $this->validate($request, [
            'conteudo'       => 'required',
            'logradouro'     => 'required',
            'numero'         => 'required',
            'bairro'         => 'required',
            'municipio'      => 'required',
            'uf'             => 'required',
            'latitude'       => 'required',
            'longitude'      => 'required',
            'foto'           => 'required',
            'solicitante_id' => 'required',
            'servico_id'     => 'required'
        ], [
            'conteudo.required' => "Por favor, descreva sua solicitação."
        ]);

        $solicitante = Solicitante::find($request->solicitante_id);

        $solicitacao = $solicitante->solicitacoes()->create($request->all());

    	// Obter o prazo padrão para o tipo de serviço selecionado
    	$prazo = $solicitacao->servico->prazo;

    	// Gravar o prazo padrão no momento da criação da solicitação
    	$solicitacao->prazo = $prazo;
    	$solicitacao->save();

        // Gravar o endereço
        $solicitacao->endereco()->create($request->all());

        // Enviar uma notificação para os navegadores atualizarem-se

        $tokens = FCM_Token::where('celular', 0)->whereHas('user.funcionario.setor', function($query) use ($solicitacao)
        {
            // Buscar apenas pelas tokens dos funcionários que pertençam ao setor da solicitação feita
            $query->where('id', $solicitacao->servico->setor->id);

        })->get()->pluck('token')->toArray();

        $dados = [
            'operacao' => 'atualizar',
            'acao'     => 'atualizar',
            'model'    => 'solicitacao',
            'motivo'   => 'nova',
            'solicitacao_id' => $solicitacao->id,
        ];

        enviarNotificacao("Nova Solicitação", "ID $solicitacao->id", $tokens, $dados);

        return $solicitacao->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitacao = Solicitacao::find($id);

    	if($solicitacao){

    		if($solicitacao->status == "Aberta"){

                $id_solicitacao = $solicitacao->id;

    		    $solicitacao->delete();

                // Enviar uma notificação para que os navegadores atualizem-se

                $tokens = FCM_Token::where('celular', 0)->whereHas('user.funcionario.setor', function($query) use ($solicitacao)
                {
                    // Buscar apenas os tokens de funcionários do mesmo setor da solicitação relacionada ao comentário

                    $query->where('id', $solicitacao->servico->setor->id);

                })->get()->pluck('token')->toArray();

                $dados = [
                    'operacao' => 'atualizar',
                    'acao'     => 'atualizar'
                ];

                $resultados = enviarNotificacao("Solicitacao ".$solicitacao->id, "Excluída pelo próprio usuário", $tokens, $dados);

    	    	$resposta = new \stdClass();
    	    	$resposta->status = true;
                $resposta->resultados = $resultados;

                //////////////////// Auditar

                trilha_solicitante_exclui_solicitacao($solicitacao->solicitante->id, $solicitacao->id);

    	    	return json_encode($resposta);

    		} else {

    	    	$resposta = new \stdClass();
    	    	$resposta->status = false;
    	    	$resposta->mensagem = "Essa solicitação não pode ser excluída pois já está sendo analisada pela Prefeitura.";

    	    	return json_encode($resposta);

    		}
    	} else {

    		$resposta = new \stdClass();
    		$resposta->status = false;
    		$resposta->mensagem = "Essa solicitação não existe.";

    	}
    }

    /**
     * Minhas Solicitações
     * Retorna apenas as solicitações criadas pelo usuário atualmente logado, independente do status
     */

    public function minhas(Request $request){

	if($request->todos){

		$solicitacoes = Solicitacao::with([
        	    'solicitante', 
            	'comentarios', 
            	'comentarios.funcionario', 
	            'comentarios.funcionario.setor.secretaria',
	            'servico',
	            "servico.setor",
	            'servico.setor.secretaria',
	            'apoiadores'
	        ])
	        ->withCount('apoiadores')
	        ->where("solicitante_id", $request->id)
	        ->orderBy('created_at', 'desc')
	        ->get();
	} else {

		$solicitacoes = Solicitacao::with([
            		'solicitante', 
            		'comentarios', 
            		'comentarios.funcionario', 
            		'comentarios.funcionario.setor.secretaria',
            		'servico',
            		"servico.setor",
            		'servico.setor.secretaria',
            		'apoiadores'
        	])
        	->withCount('apoiadores')
        	->where("solicitante_id", $request->id)
        	->orderBy('created_at', 'desc')
		->limit(10)
        	->get();

	}

        return $solicitacoes->toJson();

    }

}
