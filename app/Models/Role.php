<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model implements AuditableContract
{
	use \OwenIt\Auditing\Auditable;
	
   // Fillables

    protected $fillable = [
    	'acesso',
     	'peso',
    	
    ];

    // Relacionamentos

  	public function funcionarios()
 	{
        return $this->hasMany('App\Models\Funcionario');
 	}


}
