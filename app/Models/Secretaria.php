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



    public function endereco()
	{
		return $this->hasOne('App\Models\endereco');
	}

    public function setores()
    {
        return $this->hasMany('App\Models\setor');
    }

	public function funcionarios()
    {
        return $this->hasMany('App\Models\Funcionario');
    }
}
