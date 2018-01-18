<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Apoio extends Model implements AuditableContract
{
   use \OwenIt\Auditing\Auditable;

   protected $table = "apoios";

 	protected $fillable =[

		'solicitante_id',
     	'solicitacao_id',
     	
 	];
}
