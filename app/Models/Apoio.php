<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apoio extends Model
{
   protected $table = "apoios";

 	protected $fillable =[

		'solicitante_id',
     	'solicitacao_id',
     	
 	];
}
