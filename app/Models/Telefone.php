<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
	protected $table = "telefones";

    protected $fillable =[
	 	
        'numero', 
        'tipo_telefone',
    ];


	public function solicitante()
    {
    	return $this->belongsTo('App\Models\Solicitante', 'solicitante_id');
    }

    public function setor()
    {
        return $this->belongsTo('App\Models\Setor', 'setor_id');
    }

    public function secretaria()
    {
        return $this->belongsTo('App\Models\Secretaria', 'secretaria_id');
    }
}
