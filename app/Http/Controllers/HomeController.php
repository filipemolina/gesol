<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Endereco;
use App\Models\User;
use Carbon\Carbon;
use DataTables;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            

        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);
        //dd($funcionario_logado->acesso);

        
        //dd($funcionario_logado->role->peso);

        if( Solicitacao::count() > 0)
        {

            /*$solicitacoes = Solicitacao::withCount('apoiadores')
                                        ->withCount('comentarios')
                                        ->with('endereco')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);*/

            // chama a view de acordo com o tipo de acesso do usuario logado
            if($funcionario_logado->role->peso == 10 ) //"Moderador"
            {
                return view('dashboard.dash-moderador', compact(/*'solicitacoes',*/'funcionario_logado'));

            }

            if($funcionario_logado->role->peso == 20 ) //"SAC"
            {
                return view('dashboard.dash-moderador', compact(/*'solicitacoes',*/'funcionario_logado'));

            }

            if($funcionario_logado->role->peso == 30){ //"FUNCIONARIO"
                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));
            
            }

            if($funcionario_logado->role->peso == 40){
                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));
            
            }

            if($funcionario_logado->role->peso == 50){
                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));
            
            }

            if($funcionario_logado->role->peso == 60){
                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));            
            
            }

            if($funcionario_logado->role->peso == 70){
                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));                            

            }

            if($funcionario_logado->role->peso == 80){
                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));                            
            }

            if($funcionario_logado->role->peso == 90){


                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));                            
            }

            if($funcionario_logado->role->peso == 100){
                
                return view('dashboard.dash-funcionario', compact(/*'solicitacoes',*/'funcionario_logado'));                            
            }

            

        }else{
            dd("Nenhuma solicitação cadastrada");
        }
    }

}


//  "1"     "Desativado"        "0"     
//  "2"     "Moderador"         "10"    
//  "3"     "SAC"               "20"    
//  "4"     "Funcionario"       "30"    
//  "5"     "Funcionario_SUP"   "40"    
//  "6"     "Funcionario_ADM"   "50"    
//  "7"     "Secretario"        "60"    
//  "8"     "Ouvidor"           "70"    
//  "9"     "Prefeito"          "80"    
//  "10"    "TI"                "90"    
//  "11"    "DSV"               "100"   
