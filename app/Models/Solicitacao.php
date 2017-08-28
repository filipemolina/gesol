<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
   protected $table = "solicitacoes";

    protected $fillable =[
		'foto',
        'conteudo',
        'status',
        'moderado',
        'prioridade',
    ];


    public function servico()
    {
    	return $this->belongsTo('App\Models\Servico');
    }

	public function solicitante()
    {
    	return $this->belongsTo('App\Models\Solicitante');
    }

    public function endereco()
	{
		return $this->hasOne('App\Models\Endereco');
	}

	public function comentarios()
    {
        return $this->hasMany('App\Models\Comentario');
    }
}
