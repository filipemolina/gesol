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



if (! function_exists('dashboardFuncionario')) {
   function dashboardFuncionario(){

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

      ->select('servicos.nome', DB::raw('count(*) as total'))       
         
         ->join('servicos', 'servicos.id', '=', 'solicitacoes.servico_id')
         ->join('setores', 'setores.id', '=', 'servicos.setor_id')
         ->join('secretarias', 'secretarias.id', '=', 'setores.secretaria_id')

         ->where('solicitacoes.created_at','>=', $data_inicio_ano_anterior)
         ->where('solicitacoes.created_at','<=', $data_fim_ano_anterior)
         ->where('secretarias.id', $secretaria_funcionario_logado)

         ->groupBy('servicos.nome')
         ->orderBy('total','desc')
         ->take(10)->get();
  

   // ==============================================================================================
   //    MAIORES SOLICITADOS ANO CORRENTE
   // ==============================================================================================

      $solicitacoes_maiores = DB::table('solicitacoes')
         
         ->select('servicos.nome', DB::raw('count(*) as total'))       
         
         ->join('servicos', 'servicos.id', '=', 'solicitacoes.servico_id')
         ->join('setores', 'setores.id', '=', 'servicos.setor_id')
         ->join('secretarias', 'secretarias.id', '=', 'setores.secretaria_id')

         ->where('solicitacoes.created_at','>=', $data_inicio)
         ->where('solicitacoes.created_at','<=', $data_fim)
         ->where('secretarias.id', $secretaria_funcionario_logado)

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
