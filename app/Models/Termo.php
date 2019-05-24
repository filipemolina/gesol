<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Termo extends Model implements AuditableContract
{
	use \OwenIt\Auditing\Auditable;
	
    protected $table = "termos";

    protected $fillable =[

		'termo',
 	];
}
