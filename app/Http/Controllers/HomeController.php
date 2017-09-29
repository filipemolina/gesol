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

        $funcionario    = Funcionario::find(Auth::user()->funcionario_id);
        //dd($funcionario->user->avatar);
        if( Solicitacao::count() > 0)
        {

            /*$solicitacoes = Solicitacao::withCount('apoiadores')
                                        ->withCount('comentarios')
                                        ->with('endereco')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);*/

            // chama a view de acordo com o tipo de acesso do usuario logado
            switch($funcionario->acesso)
            {
                case "Moderador":
                    return view('dashboard.dash-moderador', compact(/*'solicitacoes',*/'funcionario'));
                    break;

                case "Funcionario":
                    return view('dashboard.dash-funcionario', compact('solicitacoes','funcionario'));
                    break;
            }

        }else{
            dd("Nenhuma solicitação cadastrada");
        }
    }

}
