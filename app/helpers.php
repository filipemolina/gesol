<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Movimento;
use App\Models\Endereco;
use App\Models\User;


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
      
      $funcionario    = Funcionario::find(Auth::user()->funcionario_id);

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
  
  function somar_data($data, $dias, $meses, $ano){
    $data = explode("/", $data);
    $resData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
    return $resData;

    //fonte: http://www.rafaelwendel.com/2012/05/funcao-para-somar-data-em-php/
  }
}

