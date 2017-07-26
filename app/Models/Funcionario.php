<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    // Fillables

    protected $fillable = [
    	'cpf',
    	'matricula',
    	'cargo',
    	'foto',
    ];

    // Relacionamentos

    public function secretaria()
    {
    	return $this->belongsTo('App\Models\Secretaria');
    }

    public function user()
    {
    	return $this->hasOne('App\User');
    }
}
