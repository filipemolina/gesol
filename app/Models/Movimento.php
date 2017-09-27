<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
   protected $fillable = [
 		'andamento',
 	];


 	public function solicitacao()
    {
    	return $this->belongsTo('App\Models\Solicitacao', 'solicitacao_id');
    }

	public function funcionario()
    {
    	return $this->belongsTo('App\Models\Funcionario', 'funcionario_id');
   }

	public function comentario()
 	{
    	return $this->belongsTo('App\Models\Funcionario', 'funcionario_id');
   }
}


