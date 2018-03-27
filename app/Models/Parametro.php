<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Parametro extends Model implements AuditableContract
{
	use \OwenIt\Auditing\Auditable;

    protected $fillable = [
 		'parametro',
 		'valor',
 	];
}
