<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icone extends Model
{
	protected $table = "icones";

 	protected $fillable =[

		'classe',
     	'nome',
     	
 	];
}
