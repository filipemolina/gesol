<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Semus_RelatorioController extends Controller
{
   

   private $Semus_relatorio;

    public function __construct()
    { 
        $this->middleware('auth');
    }

    public function index()
    {

       return view ('semus_relatorios.relatorios');

    }

    
    public function create()
    {
       
        return view ('semus_relatorios.create');

    }

    
    public function store(Request $request)
    {
       
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
