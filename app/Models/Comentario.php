<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
 
 	protected $table = "comentarios";

    protected $fillable =[

	  	'comentario',
		'encerramento',
	    'lida',
 	];

 	public function solicitacao()
    {
    	return $this->belongsTo('App\Models\Solicitacao', 'solicitacao_id');
    }

	public function funcionario()
    {
    	return $this->belongsTo('App\Models\Funcionario', 'funcionario_id');
    }
}
