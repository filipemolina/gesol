<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class servico extends Model
{
	protected $table = "servicos";

    protected $fillable =[
        'nome',

    ];


    public function setor()
    {
    	return $this->belongsTo('App\Models\setor');
    }

	public function solicitacoes()
    {
        return $this->hasMany('App\Models\solicitacao');
    }
}
