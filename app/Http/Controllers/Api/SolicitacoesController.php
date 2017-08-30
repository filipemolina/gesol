<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Solicitacao;

class SolicitacoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Solicitacoes = Solicitacao::with([
            'solicitante', 
            'comentarios', 
            'comentarios.funcionario', 
            'comentarios.funcionario.setor.secretaria',
            'servico',
            'servico.setor.secretaria',
        ])->orderBy('created_at', 'desc')->limit(10)->get();

        return $Solicitacoes->toJson();
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
            'servico.setor.secretaria',
        ])
        ->where("solicitante_id", $request->id)
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();

        return $solicitacoes->toJson();

    }
}
