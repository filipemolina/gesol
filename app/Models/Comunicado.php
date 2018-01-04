<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    // Campos liberados para preenchimento via formulário
    protected $fillable = [
    	'imagem',
    	'titulo',
    	'subtitulo',
    	'texto',
    	'funcionario_id'
    ];

    public function funcionario()
    {
    	return $this->belongsTo('App\Models\Funcionario', 'funcionario_id');
    }
}
