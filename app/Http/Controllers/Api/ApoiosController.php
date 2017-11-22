<?php

namespace App\Http\Controllers\Api;

use App\Models\Apoio;
use App\Models\Solicitacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApoiosController extends Controller
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
     * Cria ou remove um apoio para a solicitação especificada
     *
     * @param int solicitacao_id
     * @param int solicitante_id
     */

    public function apoiar(Request $request)
    {
    
        $apoiado = Apoio::where('solicitacao_id', $request->solicitacao_id)
                        ->where('solicitante_id', $request->solicitante_id)
                        ->get();

        if($apoiado->count())
        {
            $apoiado[0]->delete();
            
        }else{
            // Criar um novo apoio
            $apoio = new Apoio($request->all());
            $apoio->save();
        }           

        // Contar quantos apoios já foram feitos
        $solicitacao = Solicitacao::find($request->solicitacao_id);

        return $solicitacao->apoiadores->count();
    }    
}
