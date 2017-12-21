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

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use App\FCM;


//verifica o tipo de acesso que o usuário logado tem no sistema
if (! function_exists('verificaAcesso')) {
   function verificaAcesso($funcionario_logado) {
     
      switch ($funcionario_logado->role->peso) {
         case 10: return "PREFEITURA"; break;   //"Moderador"
         case 20: return "PREFEITURA"; break;   //"SAC"
         case 30: return "SETOR";      break;   //"Funcionario"
         case 40: return "SETOR";      break;   //"Funcionario_SUP"
         case 50: return "SECRETARIA"; break;   //"Funcionario_ADM"
         case 60: return "SECRETARIA"; break;   //"Secretario"
         case 70: return "PREFEITURA"; break;   //"Ouvidor"
         case 80: return "PREFEITURA"; break;   //"Prefeito"               
         case 90: return "PREFEITURA"; break;   //"TI"
         case 100:return "PREFEITURA"; break;   //"DSV"
         default:return "SETOR"; break;   //"DSV"
      }
   }
}

// serve para mostrar no título da TOPBAR a area de abrangencia do usuário logado --> novo
//verifica o tipo de acesso que o usuário logado tem no sistema
if (! function_exists('mostraAcesso')) {
   function mostraAcesso($funcionario_logado) {
      //$funcionario_logado   = Funcionario::find(Auth::user()->funcionario_id);

      if(verificaAcesso($funcionario_logado) == 'PREFEITURA' ){
         return("- PREFEITURA");
      } elseif(verificaAcesso($funcionario_logado) == 'SECRETARIA' ){

         return("- " . $funcionario_logado->setor->secretaria->nome );
      
      } else if(verificaAcesso($funcionario_logado) == 'SETOR' ){
         return("- " .$funcionario_logado->setor->nome );
      };
   }
}




//pega os valores enum em um campo
if (! function_exists('pegaValorEnum')) {
   function pegaValorEnum($table, $column) {
      $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
      preg_match('/^enum\((.*)\)$/', $type, $matches);
      $enum = array();
      foreach( explode(',', $matches[1]) as $value )
      {
         $v = trim( $value, "'" );
         $enum[] = $v;
      }
      
      return $enum;
   }
}


if (! function_exists('camelcase')) {
   function camelcase($string)
   {
      $words = explode(' ', strtolower(trim(preg_replace("/\s+/", ' ', $string))));
      $return[] = ucfirst($words[0]);
      unset($words[0]);
 
      foreach ($words as $word)
      {
         if (!preg_match("/^([dn]?[aeiou][s]?|em)$/i", $word))
         {
            $word = ucfirst($word);
         }
         $return[] = $word;
      }
     
      return implode(' ', $return);
   }

   if (! function_exists('trilha')) {
      function trilha($solicitacao, $campo, $valor,$andamento,$motivo,$comentario)
      {
      
         $funcionario   = Funcionario::find(Auth::user()->funcionario_id);


         $movimento = new Movimento([
            'funcionario_id'  => $funcionario->id,
            'solicitacao_id'  => $solicitacao,
            'campo_alterado'  => $campo,
            'valor_antigo'    => $valor,
            'andamento'       => $andamento,
            'motivo'          => $motivo,
            'comentario_id'   => $comentario,
         ]);
         return $movimento->save(); 
      }
   }
  
   function pega_ip() 
   {

      $ip;
      if     (getenv("HTTP_CLIENT_IP"))         $ip = getenv("HTTP_CLIENT_IP");
      else if(getenv("HTTP_X_FORWARDED_FOR"))   $ip = getenv("HTTP_X_FORWARDED_FOR"); 
      else if(getenv("REMOTE_ADDR"))            $ip = getenv("REMOTE_ADDR");
      else                                      $ip = "UNKNOWN";
      return $ip;
   }


   function somar_data($data, $dias, $meses, $ano){
      $data = explode("/", $data);
      $resData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
      return $resData;
      //fonte: http://www.rafaelwendel.com/2012/05/funcao-para-somar-data-em-php/
   }

   if (! function_exists('loga')) {
      function loga($acao, $tabela, $chave, $campo, $valor_antigo, $motivo)
      {
      
         //verifica se já está logado
         if(Auth::user())
         {
            $funcionario_logado        = Funcionario::find(Auth::user()->funcionario_id);
            $id_do_funcionario_logado  = $funcionario_logado->id;
         }else{
            $funcionario_logado        = '1';
            $id_do_funcionario_logado  = '1';
         }

         //$ip            = $_SERVER["REMOTE_ADDR"];
         //$maquina       = $_SERVER["REMOTE_HOST"];

         $ip            = pega_ip();
         $maquina       = exec('hostname');
         $local_user    = exec('whoami');

        //dd($ip);

         $log = new Sys_log([
            'acao'            => $acao,
            'tabela'          => $tabela,
            'chave'           => $chave,
            'campo'           => $campo,
            'valor_antigo'    => $valor_antigo,
            'motivo'          => $motivo,
            'funcionario_id'  => $id_do_funcionario_logado,
            'ip'              => $ip,
            'maquina'         => $maquina,
            'local_user'      => $local_user,

         ]);

         return $log->save(); 
      }
   }
  
}

if(!function_exists("enviarNotificacao")){

   function enviarNotificacao($titulo, $subtitulo, $destinatarios, $dados){

      // Enviar uma notificação para o dispositivo do usuário que criou a solicitação

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder($titulo);
      $notificationBuilder
         ->setTitle($titulo)
         ->setBody($subtitulo)
         ->setSound('default')
         ->setIcon('https://360.mesquita.rj.gov.br/gesol/img/brasao.png');

      $dataBuilder = new PayloadDataBuilder();

      foreach($dados as $key => $value){

         $dataBuilder->addData([$key => $value]);

      }

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();

      $downstreamResponse = FCM::sendTo($destinatarios, $option, $notification, $data);

      return [
         'sucesso' => $downstreamResponse->numberSuccess(),
         'falha' => $downstreamResponse->numberFailure(),
         'modificar' => $downstreamResponse->numberModification(),
         'tokens' => [
            'deletar' => $downstreamResponse->tokensToDelete(),
            'modificar' => $downstreamResponse->tokensToModify(),
            'tentar_denovo' => $downstreamResponse->tokensToRetry()
         ]
      ];

      // Fim do envio da notificação

   }

}

if(!function_exists("enviarDadosParaApp")){

   function enviarDadosParaApp($destinatarios, $dados){

      // Enviar uma notificação para o dispositivo do usuário que criou a solicitação

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData($dados);

      $option = $optionBuilder->build();
      $data = $dataBuilder->build();

      $downstreamResponse = FCM::sendTo($destinatarios, $option, null, $data);

      return [
         'sucesso' => $downstreamResponse->numberSuccess(),
         'falha' => $downstreamResponse->numberFailure(),
         'modificar' => $downstreamResponse->numberModification(),
         'tokens' => [
            'deletar' => $downstreamResponse->tokensToDelete(),
            'modificar' => $downstreamResponse->tokensToModify(),
            'tentar_denovo' => $downstreamResponse->tokensToRetry()
         ]
      ];

   }

}