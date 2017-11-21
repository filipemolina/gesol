<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Endereco;

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
        ])->where('moderado', '1')->where('status', '<>', 'Recusada')->withCount('apoiadores')->orderBy('created_at', 'desc')->skip($offset)->limit(10)->get();

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
        ]);

        $solicitante = Solicitante::find($request->solicitante_id);

        $solicitacao = $solicitante->solicitacoes()->create($request->all());

        $solicitacao->endereco()->create($request->all());

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
        //
    }

    /**
     * Minhas Solicitações
     * Retorna apenas as solicitações criadas pelo usuário atualmente logado, independente do status
     */

    public function minhas(Request $request){

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

        return $solicitacoes->toJson();

    }

    public function scroll(Request $request){

	

    }
}
