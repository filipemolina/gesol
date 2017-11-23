<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Movimento;
use App\Models\Endereco;
use App\Models\Sys_log;
use App\Models\User;
use Carbon\Carbon;


/**
* Recebe todas as solicitações e retorna um array com 12 posições, uma para cada mês
* com as solicitações correspondentes
*/
if (! function_exists('solicitacoesPorMes')) {
   function solicitacoesPorMes($solicitacoes){

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
}

 /**
 * Recebe todas as solicitações o total das solicitações que estão atrasadas
 */
if (! function_exists('solicitacoesPrazo')) {
   function solicitacoesPrazo($solicitacoes){

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
}

if (! function_exists('mediaSolucao')) {
   function mediaSolucao($solicitacoes){
  

      foreach($solicitacoes as $sol){

         if($sol->status == "Solucionada")
         {
            $tempo[] = $sol->created_at->diffInDays($sol->updated_at);
         }
      }

      //testa se a variável tempo existe, se não existir significa que ainda não existem solicitações solucionadas
      if(isset($tempo)){
         $media_solucao = intval(round(array_sum($tempo) / count(array_filter($tempo)),0));
      }else{
         $media_solucao = 0;
      }

      return $media_solucao; 
   }
}



if (! function_exists('dashboardTI')) {
   function dashboardTI(){
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

      return $resultados;   }
}