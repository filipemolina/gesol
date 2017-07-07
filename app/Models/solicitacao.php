<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class solicitacao extends Model
{
   protected $table = "solicitacoes";

    protected $fillable =[
		'foto',
        'conteudo',
        'status',
        'prioridade',
    ];


    public function servico()
    {
    	return $this->belongsTo('App\Models\servico');
    }

	public function solicitante()
    {
    	return $this->belongsTo('App\Models\solicitante');
    }

    public function endereco()
	{
		return $this->hasOne('App\Models\endereco');
	}

	public function mensagens()
    {
        return $this->hasMany('App\Models\mensagem');
    }
}
