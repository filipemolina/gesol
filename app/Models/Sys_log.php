<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sys_log extends Model
{
    
 	protected $fillable = [
		'acao',
    	'tabela',
    	'chave',
    	'campo',
    	'valor_antigo',
    	'motivo',
    	'funcionario_id',
 	];


	public function funcionario()
 	{
    	return $this->belongsTo('App\Models\Funcionario', 'funcionario_id');
	}

}
