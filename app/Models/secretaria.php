<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{

 	protected $table = "secretarias";

    protected $fillable =[

    	'nome',
        'secretario',
        'sigla',
        'email',
        'telefone',
        'inicio_atendimento',
        'termino_atendimento',
    ];



    public function Endereco()
	{
		return $this->hasOne('App\Models\endereco');
	}

    public function Setores()
    {
        return $this->hasMany('App\Models\setor');
    }

	public function Users()
    {
        return $this->hasMany('App\Models\User');
    }
}
