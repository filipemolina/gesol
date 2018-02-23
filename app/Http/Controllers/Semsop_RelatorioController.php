<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Semsop_relatorio;

class Semsop_RelatorioController extends Controller
{

    private $Semsop_relatorio;

    public function __construct()
    { 
        $this->middleware('auth');
    }
    

    public function index()
    {
         return view ('relatorios.relatorios');
    }

    
    public function create()
    {
         return view ('relatorios.create');
    }

    
    public function store(Request $request)
    {
        
        $Semsop_relatorio = new Semsop_relatorio($request->all());
        $Semsop_relatorio->save();

        return redirect(url('/'));


    }
    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
      
    }
  }
