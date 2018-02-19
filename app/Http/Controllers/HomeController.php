<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Secretaria;
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

      $secretarias           = Secretaria::all()->sortBy('nome');
      $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

      // rotina de segurança, caso alguem não tenha funcionario_id mas tenha solicitante_id e tenha usado
      // a rotina para gerar nova senha por email
      if (! $funcionario_logado) {
         Auth::logout();
         return redirect("/");
      }
      

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




      if( Solicitacao::count() > 0)
      {
         //$resultados = $this->preparaDashboard($funcionario_logado->role->acesso);

         switch ($funcionario_logado->role->peso) {
            case 10:  
                  $viu='dash-Moderador'     ; 
                  //$resultados = dashboardModerador();     
                  break;   //MODERADOR
                  
            case 20:  
                  $viu='dash-Moderador'     ; 
                  //$resultados = dashboardModerador();     
                  break;   //SAC
                  

            case 30:  
                  $viu='dash-Funcionario'   ; 
                  //$resultados = dashboardFuncionario();   
                  break;   //FUNCIONARIO
                  
            case 40:  
                  $viu='dash-Funcionario'   ; 
                  //$resultados = dashboardFuncionario();   
                  break;   //FUNCIONARIO_SUP
                  
            case 50:  
                  $viu='dash-Funcionario'   ; 
                  //$resultados = dashboardFuncionario();   
                  break;   //FUNCIONARIO_ADM
                  
            case 60:  
                  $viu='dash-Funcionario'   ; 
                  //$resultados = dashboardFuncionario();   
                  break;   //SECRETARIO
                  

            case 70:  
                  $viu='dash-Prefeito'      ; 
                  //$resultados = dashboardPrefeito();      
                  break;   //OUVIDOR
                  
            case 80:  
                  $viu='dash-Prefeito'      ; 
                  //$resultados = dashboardPrefeito();      
                  break;   //PREFEITO
                  
            
            case 90:  
                  $viu='dash-TI'            ; 
                  //$resultados = dashboardTI();            
                  break;   //TI
                  
            case 100: 
                  $viu='dash-TI'            ; 
                  //$resultados = dashboardTI();            
                  break;   //DSV
                  
         }



         if( $funcionario_logado->role->peso >= 30 and $funcionario_logado->role->peso <= 60 )
         {
            //FUNCIONARIO
            //FUNCIONARIO_SUP
            //FUNCIONARIO_ADM
            //SECRETARIO
            // ==============================================================================================
            //    TOTAL TODAS AS SOLICITAÇÕES
            // ==============================================================================================
            $solicitacoes_todas = Solicitacao::whereHas('servico', function($q) use ($secretaria_funcionario_logado){
               $q->whereHas('setor', function($q2) use ($secretaria_funcionario_logado){
                  $q2->whereHas('secretaria', function($q3) use ($secretaria_funcionario_logado){
                      $q3->where('id', $secretaria_funcionario_logado);
                  });
               });
            })->get();


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


            
         }elseif  (( $funcionario_logado->role->peso >= 10 and $funcionario_logado->role->peso <= 20)  or
                   ( $funcionario_logado->role->peso >= 70 and $funcionario_logado->role->peso <= 100) )
         {
            //MODERADOR
            //SAC

            //OUVIDOR
            //PREFEITO
            //TI
            //DSV


            //    TOTAL TODAS AS SOLICITAÇÕES
            // ==============================================================================================
            $solicitacoes_todas  = Solicitacao::with(['endereco', 'servico', 'servico.setor', 'servico.setor.secretaria'])->get();

            //    TOTAL ANO ANTERIOR 
            // ==============================================================================================
            $solicitacoes_ano_anterior = Solicitacao::with(['endereco', 'servico', 'servico.setor', 'servico.setor.secretaria'])
            ->where('created_at','>=', $data_inicio_ano_anterior)->where('created_at','<=', $data_fim_ano_anterior)
            ->get();

            //    TOTAL ANO CORRENTE
            // ==============================================================================================
            $solicitacoes  = Solicitacao::with(['endereco', 'servico', 'servico.setor', 'servico.setor.secretaria'])
               ->where('created_at','>=', $data_inicio)->where('created_at','<=', $data_fim)
               ->get();

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
            
            //    SOLICITAÇÕES POR BAIRRO
            // ==============================================================================================
            $solicitacoes_bairro = DB::table('enderecos')
               ->join('solicitacoes',   'solicitacoes.id',    '=', 'enderecos.solicitacao_id')
               ->select('enderecos.bairro', DB::raw('count(*) as total'))
               ->where('solicitacoes.created_at','>=', $data_inicio)
               ->where('solicitacoes.created_at','<=', $data_fim)         
               ->groupBy('enderecos.bairro')
               ->orderBy('total','desc')
               ->get();

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
                     if ($um_servico->solicitacoes()->where('solicitacoes.created_at','>=', $data_inicio)
                                                    ->where('solicitacoes.created_at','<=', $data_fim)->count() >= 1)
                     {
                        //$item[$um_servico->nome] = $um_servico->solicitacoes()->count();
                        $item[$um_servico->nome] = $um_servico->solicitacoes()
                                                                  ->where('solicitacoes.created_at','>=', $data_inicio)
                                                                  ->where('solicitacoes.created_at','<=', $data_fim)->count();
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
         }




         // ==============================================================================================
         // ==============================================================================================   

        
         $sol_por_mes                = solicitacoesPorMes($solicitacoes);
         $sol_por_mes_ano_anterior   = solicitacoesPorMes($solicitacoes_ano_anterior);

         $sol_prazo                  = solicitacoesPrazo($solicitacoes_todas);
         $sol_media                  = mediaSolucao($solicitacoes_todas);
         $abertas                    = $solicitacoes_todas->where('status', 'Aberta')->count();



         return view('dashboard.'.$viu, compact('resultados','secretarias',
            'ano',
            'ano_anterior', 
            'solicitacoes_todas',
            'solicitacoes',
            'solicitacoes_ano_anterior',
            'abertas',
            'sol_prazo',
            'sol_media', 
            'sol_por_mes',
            'sol_por_mes_ano_anterior',
            'solicitacoes_maiores',
            'solicitacoes_maiores_ano_anterior',
            'solicitacoes_secretaria_total',
            'solicitacoes_secretaria_aberta', 
            'solicitacoes_bairro', 
            'servicos_mais_solicitados_secretaria', 
            'secretarias_graficos',
            'secretarias_select'
         ));

      }else{
         dd("Nenhuma solicitação cadastrada");
      }
   }

   /**
   * Função utilizada para testar o Pusher
   */
   public function pusher(){

   	$solicitantes = Solicitante::all();
   	$tokens = [];

   	foreach($solicitantes as $solicitante){

   	    if($solicitante->fcm_id)
                   $tokens[] = $solicitante->fcm_id;

   	}

   	// Enviar mensagem pelo Firebase Cloud Message
   	$optionsBuilder = new OptionsBuilder();
   	$optionsBuilder->setTimeToLive(60*20);

   	$notificationBuilder = new PayloadNotificationBuilder('Teste para todos os usuários cadastrados');
   	$notificationBuilder->setBody('Olá Munícipes')->setSound('default')->setClickAction("FCM_PLUGIN_ACTIVITY");

   	$dataBuilder = new PayloadDataBuilder();
   	$dataBuilder->addData([
                              'mensagem' => 'Teste de mensagem para todos os munícipes', 
                              'operacao' => 'atualizar',
                              'acao'     => 'atualizar',
                              'model'    => 'comunicado'
                              ]);

   	$option = $optionsBuilder->build();
   	$notification = $notificationBuilder->build();
   	$data = $dataBuilder->build();

   	$downstreamResponse = FCM::sendTo(['fB7YNSkJIx4:APA91bHzgmalYWq9D5BNfyklQQDkD-1l3_N7s0Fx6BFBoGKtvaqX5PR5SR0pM3uCYoLqeRG4-Oc17h9bmpL4E6g2EkX3tbkskWmeKfi0Hft0XE-IrSyVBlJTKcxwIXeyepy6RjwAOCP9'], $option, $notification, $data);

   	dd([$downstreamResponse->numberSuccess(), $downstreamResponse->numberFailure(), $downstreamResponse->numberModification()]);
   }

   /**
   *  Recebe o acesso da role do usuário logado e retorna um vetor com todas as variáveis necessárias para
   *  montar a dashboard
   */

   private function preparaDashboard($acesso){
      return $this->{'dashboard'.$acesso}();
   }

}
