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
         $resultados = $this->preparaDashboard($funcionario_logado->role->acesso);

         switch ($funcionario_logado->role->peso) {
            case 10:  $viu='dash-Moderador'  ; break;
            case 20:  $viu='dash-Sac'        ; break;
            case 30:  $viu='dash-Funcionario'; break;
            case 40:  $viu='dash-Funcionario'; break;
            case 50:  $viu='dash-Funcionario'; break;
            case 60:  $viu='dash-Secretario' ; break;
            case 70:  $viu='dash-Ouvidor'    ; break; 
            case 80:  $viu='dash-Prefeito'   ; break;
            case 90:  $viu='dash-TI'         ; break;
            case 100: $viu='dash-TI'         ; break;
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


   private function dashboardTI(){
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

   
   private function dashboardFuncionario(){

      $resultados = [];
      $funcionario_logado              = Funcionario::find(Auth::user()->funcionario_id);
      $secretaria_funcionario_logado   = $funcionario_logado->setor->secretaria->id;

      //limites de datas para pegar apenas as solicitações do ANO ANTERIOR
      $ano_anterior              = Carbon::now()->year-1;
      $data_inicio_ano_anterior  = Carbon::createFromFormat('Y-m-d H:i:s', $ano_anterior.'-01-01 00:00:00');
      $data_fim_ano_anterior     = Carbon::createFromFormat('Y-m-d H:i:s', $ano_anterior.'-12-31 23:59:59');

      //limites de datas para pegar apenas as solicitações do ANO CORRENTE
      $ano = Carbon::now()->year;
      $data_inicio   = Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-01-01 00:00:00');
      $data_fim      = Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-12-31 23:59:59');


   // ==============================================================================================
   //    TOTAL ANO ANTERIOR 
   // ==============================================================================================

      $solicitacoes_ano_anterior = Solicitacao::whereHas('servico', function($q) use ($secretaria_funcionario_logado){
         $q->whereHas('setor', function($q2) use ($secretaria_funcionario_logado){
            $q2->whereHas('secretaria', function($q3) use ($secretaria_funcionario_logado){
                $q3->where('id', $secretaria_funcionario_logado);
            });
         });
      })->where('created_at','>=', $data_inicio_ano_anterior)->where('created_at','<=', $data_fim_ano_anterior)
      ->get();

   // ==============================================================================================
   //    TOTAL ANO CORRENTE
   // ==============================================================================================


      $solicitacoes = Solicitacao::whereHas('servico', function($q) use ($secretaria_funcionario_logado){
         $q->whereHas('setor', function($q2) use ($secretaria_funcionario_logado){
            $q2->whereHas('secretaria', function($q3) use ($secretaria_funcionario_logado){
                $q3->where('id', $secretaria_funcionario_logado);
            });
         });
      })->where('created_at','>=', $data_inicio)->where('created_at','<=', $data_fim)
      ->get();

   // ==============================================================================================
   //    MAIORES SOLICITADOS ANO ANTERIOR
   // ==============================================================================================
      $solicitacoes_maiores_ano_anterior = DB::table('solicitacoes')
         ->join('servicos', 'servicos.id', '=', 'solicitacoes.servico_id')
         ->select('servicos.nome', DB::raw('count(*) as total'))
         ->where('solicitacoes.created_at','>=', $data_inicio_ano_anterior)
         ->where('solicitacoes.created_at','<=', $data_fim_ano_anterior)
         ->groupBy('servicos.nome')
         ->orderBy('total','desc')
         ->get();


   // ==============================================================================================
   //    MAIORES SOLICITADOS ANO CORRENTE
   // ==============================================================================================

      $solicitacoes_maiores = DB::table('solicitacoes')
         ->join('servicos', 'servicos.id', '=', 'solicitacoes.servico_id')
         ->select('servicos.nome', DB::raw('count(*) as total'))
         ->where('solicitacoes.created_at','>=', $data_inicio)
         ->where('solicitacoes.created_at','<=', $data_fim)         
         //->select('solicitacoes.id', 'servicos.nome')
         ->groupBy('servicos.nome')
         ->orderBy('total','desc')
         ->take(10)->get();

      
   // ==============================================================================================
   // ==============================================================================================   
/*
      $sol_por_mes               = solicitacoesPorMes($solicitacoes);
      $sol_por_mes_ano_anterior  = solicitacoesPorMes($solicitacoes_ano_anterior);

      $sol_prazo                 = solicitacoesPrazo($solicitacoes);
      $sol_media                 = mediaSolucao($solicitacoes);
*/

      $resultados['solicitacoes']               = $solicitacoes;
      $resultados['abertas']                    = $solicitacoes->where('status', 'Aberta')->count();
      $resultados['ano']                        = $ano;
      $resultados['ano_anterior']               = $ano_anterior;

      $resultados['sol_por_mes']                = solicitacoesPorMes($solicitacoes);
      $resultados['sol_por_mes_ano_anterior']   = solicitacoesPorMes($solicitacoes_ano_anterior);
      $resultados['sol_prazo']                  = solicitacoesPrazo($solicitacoes);
      $resultados['sol_media']                  = mediaSolucao($solicitacoes);

      $resultados['sol_maiores']                = $solicitacoes_maiores;
      $resultados['sol_maiores_ano_anterior']   = $solicitacoes_maiores_ano_anterior;

      //dd($resultados['sol_maiores']);

      return $resultados;
   }

}
