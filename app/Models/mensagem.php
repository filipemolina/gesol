<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mensagem extends Model
{
 
 	protected $table = "mensagens";

    protected $fillable =[

	  	'mensagem',
		'encerramento',
	    'lida',
 	];

 	public function solicitacao()
    {
    	return $this->belongsTo('App\Models\solicitacao', 'solicitacao_id');
    }

}
