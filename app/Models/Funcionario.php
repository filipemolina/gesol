<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    // Fillables

    protected $fillable = [
    	'cpf',
        'nome',
    	'matricula',
    	'cargo',
    	'foto',
    ];

    // Relacionamentos

    public function setor()
    {
    	return $this->belongsTo('App\Models\Setor');
    }

    public function user()
    {
    	return $this->hasOne('App\User');
    }
}
