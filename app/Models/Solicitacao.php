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

	public function mensagens()
    {
        return $this->hasMany('App\Models\Mensagem');
    }
}
