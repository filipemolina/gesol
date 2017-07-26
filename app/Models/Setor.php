<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = "setores";

    protected $fillable =[
    	'nome',
    ];


    public function secretaria()
    {
    	return $this->belongsTo('App\Models\Secretaria');
    }

	public function servicos()
    {
        return $this->hasMany('App\Models\Servico');
    }

     public function telefones()
    {
        return $this->hasMany('App\Models\Telefone');
    }
}
