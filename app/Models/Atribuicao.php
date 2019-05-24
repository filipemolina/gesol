<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atribuicao extends Model
{

 	protected $table = "atribuicoes";

    protected $fillable =[

	  	'atribuicao',
		'descricao',
 	];


 	public function funcionarios()
 	{
    	return $this->belongsToMany('App\Models\Funcionario','atribuicao_funcionario');
 	}
}
