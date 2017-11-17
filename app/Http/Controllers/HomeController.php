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
   * Recebe todas as solicitações e retorna um array com 12 posições, uma para cada mês
   * com as solicitações correspondentes
   */
   private function solicitacoesPorMes($solicitacoes){

      $meses = [];

      $meses['jan'] = $meses['fev'] = $meses['mar'] = $meses['abr'] = $meses['mai'] = $meses['jun'] = $meses['jul'] = $meses['ago'] = $meses['set'] = $meses['out'] = $meses['nov'] = $meses['dez'] = 0;

      foreach($solicitacoes as $sol){
         switch ($sol->created_at->month) {
            case 1:  $meses['jan']++; break;
            case 2:  $meses['fev']++; break;
            case 3:  $meses['mar']++; break;
            case 4:  $meses['abr']++; break;
            case 5:  $meses['mai']++; break;
            case 6:  $meses['jun']++; break;
            case 7:  $meses['jul']++; break; 
            case 8:  $meses['ago']++; break;
            case 9:  $meses['set']++; break;
            case 10: $meses['out']++; break;
            case 11: $meses['nov']++; break;
            case 12: $meses['dez']++; break;
         }
      }
      return array_reverse($meses);
   }


    /**
    * Recebe todas as solicitações o total das solicitações que estão atrasadas
    */

   private function solicitacoesPrazo($solicitacoes){

      $hoje = Carbon::now();
      
      $prazo = [
          "vencida"   => 0,
          "vencendo"  => 0,
          "vencer"    => 0
      ];

      $tempo =[];

      foreach($solicitacoes as $sol){

         if($sol->status == "Solucionada")
         {
            $tempo[] = $sol->created_at->diffInDays($sol->updated_at);
         }

         if($sol->status != "Solucionada" or $sol->status != "Recusada")
         {
            $diferenca = $sol->created_at->diffInDays($hoje);

            if($diferenca > $sol->prazo)
            {
               $prazo["vencida"]++;
            }else if($diferenca == $sol->prazo){
               $prazo["vencendo"]++;
            } else {
               $prazo["vencer"]++;
            }
         }
      }
      return $prazo;
   }

   private function mediaSolucao($solicitacoes){
  
      foreach($solicitacoes as $sol){

         if($sol->status == "Solucionada")
         {
            $tempo[] = $sol->created_at->diffInDays($sol->updated_at);
         }
      }

      $media_solucao = intval(round(array_sum($tempo) / count(array_filter($tempo)),0));

      return $media_solucao; 
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

      $sol_por_mes   = $this->solicitacoesPorMes($solicitacoes);
      $sol_prazo     = $this->solicitacoesPrazo($solicitacoes);
      $sol_media     = $this->mediaSolucao($solicitacoes);

      $resultados['sol_por_mes']    = $sol_por_mes;
      $resultados['sol_prazo']      = $sol_prazo;
      $resultados['sol_media']      = $sol_media;
      $resultados['solicitacoes']   = $solicitacoes;
      return $resultados;
   }

   private function dashboardModerador(){
      $resultados = [];
      $solicitacoes  = Solicitacao::with(['endereco', 'servico', 'servico.setor', 'servico.setor.secretaria'])->get();

      $sol_por_mes   = $this->solicitacoesPorMes($solicitacoes);
      $sol_prazo     = $this->solicitacoesPrazo($solicitacoes);
      $sol_media     = $this->mediaSolucao($solicitacoes);

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
      $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

      $secretaria_funcionario_logado = $funcionario_logado->setor->secretaria->id;

      $solicitacoes = Solicitacao::whereHas('servico', function($q) use ($secretaria_funcionario_logado){
         $q->whereHas('setor', function($q2) use ($secretaria_funcionario_logado){
            $q2->whereHas('secretaria', function($q3) use ($secretaria_funcionario_logado){
                $q3->where('id', $secretaria_funcionario_logado);
            });
         });
      })->get();


      $sol_por_mes   = $this->solicitacoesPorMes($solicitacoes);
      $sol_prazo     = $this->solicitacoesPrazo($solicitacoes);
      $sol_media     = $this->mediaSolucao($solicitacoes);

      $resultados['sol_por_mes']    = $sol_por_mes;
      $resultados['sol_prazo']      = $sol_prazo;
      $resultados['sol_media']      = $sol_media;
      $resultados['solicitacoes']   = $solicitacoes;
      $resultados['abertas']        = $solicitacoes->where('status', 'Aberta')->count();

      return $resultados;
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
