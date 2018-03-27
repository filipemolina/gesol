<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemperaturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string("temperature", 254);
            $table->string("wind_direction", 254);
            $table->string("wind_velocity", 254);
            $table->string("humidity", 254);
            $table->string("condition", 254);
            $table->string("pressure", 254);
            $table->string("icon", 254);
            $table->string("sensation", 254);

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
        Schema::dropIfExists('temperaturas');
    }
}
