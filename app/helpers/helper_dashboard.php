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
