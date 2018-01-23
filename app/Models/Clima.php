<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clima extends Model
{
	protected $table = 'clima';

    protected $fillable = [

      "summary",
      "icon",
      "precipIntensity",
      "precipProbability",
      "precipType",
      "temperature",
      "apparentTemperature",
      "dewPoint",
      "humidity",
      "pressure",
      "windSpeed",
      "windGust",
      "windBearing",
      "cloudCover",
      "uvIndex",
      "visibility",
      "ozone",
    ];

}
