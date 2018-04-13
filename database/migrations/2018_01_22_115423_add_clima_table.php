<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clima', function (Blueprint $table) {
            $table->increments('id');
            $table->string("summary", 254);
            $table->string("icon", 254);
            $table->string("precipIntensity", 254);
            $table->string("precipProbability", 254);
            $table->string("precipType", 254)->nullable();
            $table->string("temperature", 254);
            $table->string("apparentTemperature", 254);
            $table->string("dewPoint", 254);
            $table->string("humidity", 254);
            $table->string("pressure", 254);
            $table->string("windSpeed", 254);
            $table->string("windGust", 254);
            $table->string("windBearing", 254);
            $table->string("cloudCover", 254);
            $table->string("uvIndex", 254);
            $table->string("visibility", 254);
            $table->string("ozone", 254);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clima');
    }
}
