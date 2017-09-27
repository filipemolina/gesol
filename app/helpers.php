<?php


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
}

