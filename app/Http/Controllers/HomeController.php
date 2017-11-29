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

   
   public function index()
   {

      $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

      if( Solicitacao::count() > 0)
      {
         //$resultados = $this->preparaDashboard($funcionario_logado->role->acesso);

         switch ($funcionario_logado->role->peso) {
            case 10:  $viu='dash-Moderador'     ; $resultados = dashboardModerador();     break;   //MODERADOR
            case 20:  $viu='dash-Moderador'     ; $resultados = dashboardModerador();     break;   //SAC

            case 30:  $viu='dash-Funcionario'   ; $resultados = dashboardFuncionario();   break;   //FUNCIONARIO
            case 40:  $viu='dash-Funcionario'   ; $resultados = dashboardFuncionario();   break;   //FUNCIONARIO_SUP
            case 50:  $viu='dash-Funcionario'   ; $resultados = dashboardFuncionario();   break;   //FUNCIONARIO_ADM
            case 60:  $viu='dash-Funcionario'   ; $resultados = dashboardFuncionario();   break;   //SECRETARIO

            case 70:  $viu='dash-Prefeito'      ; $resultados = dashboardPrefeito();      break;   //OUVIDOR
            case 80:  $viu='dash-Prefeito'      ; $resultados = dashboardPrefeito();      break;   //PREFEITO
            
            case 90:  $viu='dash-TI'            ; $resultados = dashboardTI();            break;   //TI
            case 100: $viu='dash-TI'            ; $resultados = dashboardTI();            break;   //DSV
         }

         return view('dashboard.'.$viu, compact('funcionario_logado', 'resultados'));

      }else{
         dd("Nenhuma solicitação cadastrada");
      }
   }

   

   /**
   *  Recebe o acesso da role do usuário logado e retorna um vetor com todas as variáveis necessárias para
   *  montar a dashboard
   */

   private function preparaDashboard($acesso){
      return $this->{'dashboard'.$acesso}();
   }

   

   

}
