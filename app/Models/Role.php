<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
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
