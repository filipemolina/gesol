<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Comentario extends Model implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;

 	protected $table = "comentarios";

    protected $fillable =[

	  	'comentario',
		'encerramento',
	        'lida',
		'solicitacao_id',
		'funcionario_id',
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
