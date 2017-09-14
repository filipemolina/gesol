<?php

namespace App\Http\Controllers;

use App\Models\Apoio;
use App\Models\Solicitacao;
use Illuminate\Http\Request;

class ApoioController extends Controller
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
     * @param  \App\Apoios  $apoios
     * @return \Illuminate\Http\Response
     */
    public function show(Apoios $apoios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apoios  $apoios
     * @return \Illuminate\Http\Response
     */
    public function edit(Apoios $apoios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apoios  $apoios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apoios $apoios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apoios  $apoios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apoios $apoios)
    {
        //
    }






    
    public function apoiar(Request $request)
   {
    
    $apoiado = Apoio::where('solicitacao_id', $request->solicitacao_id)->where('solicitante_id', $request->solicitante_id)->get();

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
