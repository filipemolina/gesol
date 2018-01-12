<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
	protected $table = "servicos";

    protected $fillable =[
        'nome',
        'prazo',
        'operante',
        'setor_id',

    ];


    public function setor()
    {
    	return $this->belongsTo('App\Models\Setor');
    }

	public function solicitacoes()
    {
        return $this->hasMany('App\Models\Solicitacao');
    }


       
}
