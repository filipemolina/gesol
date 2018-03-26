<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Atribuicao;
use DataTables;



class AtribuicaoController extends Controller
{
   public function index()
   {
      $atribuicoes  = Atribuicao::all();
      $funcionarios = Funcionario::has('atribuicoes')->get();
      return view ('atribuicoes.index', compact('atribuicoes','funcionarios'));
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
     * @param  \App\Atribuicao  $Atribuicao
     * @return \Illuminate\Http\Response
     */
    public function show(Atribuicao $Atribuicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atribuicao  $Atribuicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Atribuicao $Atribuicao)
    {
        dd("aqui");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atribuicao  $Atribuicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atribuicao $Atribuicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atribuicao  $Atribuicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atribuicao $Atribuicao)
    {
        //
    }
}
