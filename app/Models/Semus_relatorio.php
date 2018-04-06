<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Semus_relatorio extends Model implements AuditableContract
{
   
   use \OwenIt\Auditing\Auditable;

   protected $table = "semus_relatorios";

   protected $fillable = [

   		'responsavel',
   		'relato',
   		'data',
   		'hora',
   		'prioridade',
   		'unidade',

  	];

}
