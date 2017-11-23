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
            case 10:  $viu='dash-Moderador'  ; $resultados = dashboardModerador(); break;
            case 20:  $viu='dash-Sac'        ; $resultados = dashboardSAC(); break;
            case 30:  $viu='dash-Funcionario'; $resultados = dashboardFuncionario(); break;
            case 40:  $viu='dash-Funcionario'; $resultados = dashboardFuncionario(); break;
            case 50:  $viu='dash-Funcionario'; $resultados = dashboardFuncionario(); break;
            case 60:  $viu='dash-Secretario' ; $resultados = dashboardSecretario(); break;
            case 70:  $viu='dash-Ouvidor'    ; $resultados = dashboardOuvidor(); break; 
            case 80:  $viu='dash-Prefeito'   ; $resultados = dashboardPrefeito(); break;
            case 90:  $viu='dash-TI'         ; $resultados = dashboardTI(); break;
            case 100: $viu='dash-TI'         ; $resultados = dashboardTI(); break;
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



   private function dashboardModerador(){
      $resultados = [];
      $solicitacoes  = Solicitacao::with(['endereco', 'servico', 'servico.setor', 'servico.setor.secretaria'])->get();

      $sol_por_mes   = solicitacoesPorMes($solicitacoes);
      $sol_prazo     = solicitacoesPrazo($solicitacoes);
      $sol_media     = mediaSolucao($solicitacoes);

      $resultados['sol_por_mes']    = $sol_por_mes;
      $resultados['sol_prazo']      = $sol_prazo;
      $resultados['sol_media']      = $sol_media;
      $resultados['solicitacoes']   = $solicitacoes;
      return $resultados;
   }

   private function dashboardFuncionario_SUP(){
      return $this->{'dashboardFuncionario'}();
   }

   private function dashboardFuncionario_ADM(){
      return $this->{'dashboardFuncionario'}();
   }

      
   

}
