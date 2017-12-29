<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Secretaria;
use App\Models\Movimento;
use App\Models\Endereco;
use App\Models\Sys_log;
use App\Models\User;
use Carbon\Carbon;



if (! function_exists('dashboardPrefeito')) {
   function dashboardPrefeito(){


      $resultados = [];
      $funcionario_logado              = Funcionario::find(Auth::user()->funcionario_id);
      
      //$secretaria_funcionario_logado   = $funcionario_logado->setor->secretaria->id;

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
         ->orderBy('secretarias.sigla','desc')
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
         ->orderBy('secretarias.sigla','desc')
         ->get();
   
   // ==============================================================================================
   //    SOLICITAÇÕES POR BAIRRO
   // ==============================================================================================

      $solicitacoes_bairro = DB::table('enderecos')

         ->join('solicitacoes',   'solicitacoes.id',    '=', 'enderecos.solicitacao_id')

         ->select('enderecos.bairro', DB::raw('count(*) as total'))

         ->where('solicitacoes.created_at','>=', $data_inicio)
         ->where('solicitacoes.created_at','<=', $data_fim)         
         ->groupBy('enderecos.bairro')
         ->orderBy('enderecos.bairro','asc')
         ->get();



   // ==============================================================================================
   //    SERVIÇOS MAIS SOLICITADOS  POR SECRETARIAS
   // ==============================================================================================

      $servicos_mais_solicitados_secretaria = DB::table('solicitacoes')
         ->join('servicos',   'servicos.id',    '=', 'solicitacoes.servico_id')
         ->join('setores',    'setores.id',     '=', 'servicos.setor_id')
         ->join('secretarias','secretarias.id', '=', 'setores.secretaria_id')

         ->select('secretarias.nome as secretaria','servicos.nome', DB::raw('count(*) as total'))

         ->where('solicitacoes.created_at','>=', $data_inicio)
         ->where('solicitacoes.created_at','<=', $data_fim)         
         ->groupBy('secretarias.nome','servicos.nome')
         ->orderBy('servicos.nome','asc')
         ->orderBy('total','desc')
         ->get();

         //dd($servicos_mais_solicitados_secretaria);

      // Todas as secretarias do banco
      $todas_secretarias = Secretaria::all();

      // Vetor que receberá os dados formatados para serem exibidos no gráfico
      $secretarias_graficos = [];

      //recebe as secretarias para montar o select na view
      $secretarias_select = [];

      // Iterar por todas as secretarias
      foreach($todas_secretarias as $uma_secretaria){

         // Cada item ddo vetor $secretarias_graficos
         $item = [];

         // Iterar por setor
         foreach($uma_secretaria->setores as $um_setor){

            //Iterar por serviços
            foreach($um_setor->servicos as $um_servico){

               //só adiciona o setor se tiver ao menos uma solicitação
               if ($um_servico->solicitacoes()->count() >= 1)
               {
                  $item[$um_servico->nome] = $um_servico->solicitacoes()->count();
               }

            }
         }



         //ordena de maneira decrescente o vetor deacordo com o numero de solicitações de cada serviço
         arsort($item);

         if($item != null)
         {

            $secretarias_select[] =  $uma_secretaria->nome;

            $secretarias_graficos[]=[
               'nome' => $uma_secretaria->nome,
               'servicos' => $item,
            ];
         }

      }

      //dd($todas_secretarias); 

      //dd($secretarias_select);

      
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
      $resultados['sol_secretaria_aberta']      = $solicitacoes_secretaria_aberta;

      $resultados['sol_bairro']                 = $solicitacoes_bairro;

      $resultados['ser_mais_solicitados_secretaria'] = $servicos_mais_solicitados_secretaria;

      $resultados['secretarias_graficos']    = $secretarias_graficos;
      $resultados['secretarias_select']      = $secretarias_select;

      //dd( $secretarias_graficos[2]['nome'] );

      return $resultados;
   }
   
}


