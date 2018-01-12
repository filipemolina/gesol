<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\FCM_Token;
use App\Models\Solicitacao;

class ComentariosController extends Controller
{
    /**
     * Proteger a rota com o middleware de autenticação da api
     */

    public function __construct()
    {
        $this->middleware("auth:api");
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
        // Validar

        $this->validate($request, [
            'comentario'       => 'required|min:2',
            'solicitacao_id' => 'required'
        ]);

        // Criar o comentário

        $comentario = new Comentario($request->all());

        $comentario->solicitacao_id = $request->solicitacao_id;

        $comentario->save();

        // Obter a solicitação relacionada ao comentário

        $solicitacao = Solicitacao::find($request->solicitacao_id);

        // Enviar uma notificação para que os navegadores atualizem-se

        $tokens = FCM_Token::where('celular', 0)->whereHas('user.funcionario.setor', function($query) use ($solicitacao)
        {
            // Buscar apenas os tokens de funcionários do mesmo setor da solicitação relacionada ao comentário

            $query->where('id', $solicitacao->servico->setor->id);

        })->get()->pluck('token')->toArray();

        $dados = [
            'operacao' => 'atualizar',
            'acao'     => 'atualizar',
            'model'    => 'comentario',
            'solicitacao' => $request->solicitacao_id,
            'comentario_id' => $comentario->id
        ];

        enviarNotificacao("Novo Comentário na Solicitacao ".$request->solicitacao_id, substr($request->comentario, 0, 140), $tokens, $dados);

        return json_encode(["ok" => "ok"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retornar um JSON com os dados do comentário 
        return Comentario::where('id', $id)->with('funcionario', 'funcionario.setor', 'funcionario.setor.secretaria')->first()->toJson();
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
        // Obter o comentário
        $comentario = Comentario::find($id);

        $comentario->comentario = "Comentário apagado pelo usuário";
        $comentario->save();
    }
}
