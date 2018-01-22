<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temperatura extends Model
{
	protected $table = 'temperaturas';

	protected $fillable = [

		"temperature",
		"wind_direction",
		"wind_velocity",
		"humidity",
		"condition",
		"pressure",
		"icon",
		"sensation",

	];

}
