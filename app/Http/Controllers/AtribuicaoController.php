<?php

namespace App\Http\Controllers;

use App\ModelsAtribuicao;
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
      $funcionarios = Funcionario::all();
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
     * @param  \App\ModelsAtribuicao  $modelsAtribuicao
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsAtribuicao $modelsAtribuicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsAtribuicao  $modelsAtribuicao
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsAtribuicao $modelsAtribuicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsAtribuicao  $modelsAtribuicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsAtribuicao $modelsAtribuicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsAtribuicao  $modelsAtribuicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsAtribuicao $modelsAtribuicao)
    {
        //
    }
}
