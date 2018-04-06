<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Semus_relatorio;
use App\Models\Funcionario;
use App\Models\Atribuicao;
use App\Models\User;
use App\Models\Imagem;
use PDF;

class Semus_RelatorioController extends Controller
{
   

   private $Semus_relatorio;

    public function __construct()
    { 
        $this->middleware('auth');
    }

    public function index()
    {

        $relatorios = Semus_relatorio::all();

       return view ('semus_relatorios.relatorios', compact('relatorios'));

    }

    
    public function create()
    {
       
        //Retorna os Enums para seus respectivos campos
        $prioridades = pegaValorEnum('semus_relatorios','prioridade');
        $unidades = pegaValorEnum('semus_relatorios','unidade');

        return view ('semus_relatorios.create', compact('prioridades','unidades'));

    }

    
    public function store(Request $request)
    {

        // dd($request);
        $this->validate($request, [             
            'responsavel'         =>'required',
            'relato'              =>'required',
            'data'                =>'required',
            'hora'                =>'required',
            'prioridade'          =>'required',
            'unidade'             =>'required',   

        ]);

        // Criar o relatorio
        $Semus_relatorio = new Semus_relatorio($request->all());
        // Salvar o relatório
        $Semus_relatorio->save();

        return redirect(url('/semus'));
    
    }

   
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
       
    }

    
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
        
    }
}
