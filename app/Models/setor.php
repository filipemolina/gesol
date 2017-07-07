<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class setor extends Model
{
    protected $table = "setores";

    protected $fillable =[
    	'nome',
    ];


    public function secretaria()
    {
    	return $this->belongsTo('App\Models\secretaria');
    }

	public function servicos()
    {
        return $this->hasMany('App\Models\servico');
    }
}
