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



if (! function_exists('dashboardPrefeito')) {
   function dashboardPrefeito(){

      $resultados = [];
   
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

      $solicitacoes_ano_anterior = Solicitacao::with(['endereco', 'servico', 'servico.setor', 'servico.setor.secretaria'])
      ->where('created_at','>=', $data_inicio_ano_anterior)->where('created_at','<=', $data_fim_ano_anterior)
      ->get();

   // ==============================================================================================
   //    TOTAL ANO CORRENTE
   // ==============================================================================================

      $solicitacoes  = Solicitacao::with(['endereco', 'servico', 'servico.setor', 'servico.setor.secretaria'])
         ->where('created_at','>=', $data_inicio)->where('created_at','<=', $data_fim)
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
         ->take(10)->get();


   // ==============================================================================================
   //    MAIORES SOLICITADOS ANO CORRENTE
   // ==============================================================================================

      $solicitacoes_maiores = DB::table('solicitacoes')
         ->join('servicos', 'servicos.id', '=', 'solicitacoes.servico_id')
         ->select('servicos.nome', DB::raw('count(*) as total'))
         ->where('solicitacoes.created_at','>=', $data_inicio)
         ->where('solicitacoes.created_at','<=', $data_fim)         
         ->groupBy('servicos.nome')
         ->orderBy('total','desc')
         ->take(10)->get();

   // ==============================================================================================
   //    SOLICITAÇÕES POR SECRETARIAS
   // ==============================================================================================

      $solicitacoes_secretaria_total = DB::table('solicitacoes')
         ->join('servicos',   'servicos.id',    '=', 'solicitacoes.servico_id')
         ->join('setores',    'setores.id',     '=', 'servicos.setor_id')
         ->join('secretarias','secretarias.id', '=', 'setores.secretaria_id')

         ->select('secretarias.sigla', DB::raw('count(*) as total'))

         ->where('solicitacoes.created_at','>=', $data_inicio)
         ->where('solicitacoes.created_at','<=', $data_fim)         
         ->groupBy('secretarias.sigla')
         ->orderBy('secretarias.sigla','asc')
         ->get();

      $solicitacoes_secretaria_aberta = DB::table('solicitacoes')
         ->join('servicos',   'servicos.id',    '=', 'solicitacoes.servico_id')
         ->join('setores',    'setores.id',     '=', 'servicos.setor_id')
         ->join('secretarias','secretarias.id', '=', 'setores.secretaria_id')

         ->select('secretarias.sigla', DB::raw('count(*) as total'))

         ->where('solicitacoes.created_at','>=', $data_inicio)
         ->where('solicitacoes.created_at','<=', $data_fim)         
         ->where('solicitacoes.status','<>', 'Solucionada')         
         ->where('solicitacoes.status','<>', 'Recusada')         

         ->groupBy('secretarias.sigla')
         ->orderBy('secretarias.sigla','asc')
         ->get();

      
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
      $resultados['sol_secretaria_total']       = $solicitacoes_secretaria_total;
      $resultados['sol_secretaria_aberta']       = $solicitacoes_secretaria_aberta;
      

      //dd($resultados['sol_maiores']);

      return $resultados;
   }
   
}
