<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Icone extends Model implements AuditableContract
{
	use \OwenIt\Auditing\Auditable;

	protected $table = "icones";

 	protected $fillable =[

		'classe',
     	'nome',
     	
 	];
}
