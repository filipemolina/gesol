<?php

namespace App\Console;

use GuzzleHttp;
use App\Models\Clima;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

        $schedule->call(function(){

            // Criar um client Guzzle e fazer uma chamada para a api Dark Sky

            $client = new GuzzleHttp\Client();
            $res = $client->request("GET", "https://api.darksky.net/forecast/e0224a5b39dfaf423fae50cc85645857/-22.782866,-43.431637?lang=pt&exclude=minutely,hourly,daily,alerts,flags&units=ca");

            // Salvar ao resultado da chamada
            $resposta = json_decode($res->getBody()->getContents());

            // Criar e salvar uma instância de clima

            $clima = new Clima;

            $clima->summary = $resposta->currently->summary;
            $clima->icon = $resposta->currently->icon;
            $clima->precipIntensity = $resposta->currently->precipIntensity;
            $clima->precipProbability = $resposta->currently->precipProbability;
            $clima->precipType = $resposta->currently->precipType;
            $clima->temperature = $resposta->currently->temperature;
            $clima->apparentTemperature = $resposta->currently->apparentTemperature;
            $clima->dewPoint = $resposta->currently->dewPoint;
            $clima->humidity = $resposta->currently->humidity;
            $clima->pressure = $resposta->currently->pressure;
            $clima->windSpeed = $resposta->currently->windSpeed;
            $clima->windGust = $resposta->currently->windGust;
            $clima->windBearing = $resposta->currently->windBearing;
            $clima->cloudCover = $resposta->currently->cloudCover;
            $clima->uvIndex = $resposta->currently->uvIndex;
            $clima->visibility = $resposta->currently->visibility;
            $clima->ozone = $resposta->currently->ozone;

            $clima->save();

        })->everyFiveMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
