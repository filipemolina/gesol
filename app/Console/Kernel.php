<?php

namespace App\Console;

use GuzzleHttp;
use App\Models\Clima;
use App\Models\Temperatura;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use AdinanCenci\Climatempo\Climatempo;

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

            $client = new GuzzleHttp\Client();
            
            $res = $client->request("GET", "https://api.darksky.net/forecast/e0224a5b39dfaf423fae50cc85645857/-22.782866,-43.431637?lang=pt&exclude=minutely,hourly,daily,alerts,flags&units=ca");

            // Salvar ao resultado da chamada
            $resposta = json_decode($res->getBody()->getContents());

            // Criar e salvar uma instância de clima

            $clima = new Clima;



            $clima->summary             = $resposta->currently->summary;
            $clima->icon                = $resposta->currently->icon;
            $clima->precipIntensity     = $resposta->currently->precipIntensity;
            $clima->precipProbability   = $resposta->currently->precipProbability;

            if($clima->precipProbability){
                $clima->precipType      = $resposta->currently->precipType;
            }

            $clima->temperature         = $resposta->currently->temperature;
            $clima->apparentTemperature = $resposta->currently->apparentTemperature;
            $clima->dewPoint            = $resposta->currently->dewPoint;
            $clima->humidity            = $resposta->currently->humidity;
            $clima->pressure            = $resposta->currently->pressure;
            $clima->windSpeed           = $resposta->currently->windSpeed;
            $clima->windGust            = $resposta->currently->windGust;
            $clima->windBearing         = $resposta->currently->windBearing;
            $clima->cloudCover          = $resposta->currently->cloudCover;
            $clima->uvIndex             = $resposta->currently->uvIndex;
            $clima->visibility          = $resposta->currently->visibility;
            $clima->ozone               = $resposta->currently->ozone;

            $clima->save();

            // CLIMATEMPO ================================================================

/*            $token      = 'a7d6291b515e2018ac998839ba254b7a';
            $mesquita   = 6135; //mesquita

            $climatempo = new Climatempo($token);
            $previsao   = $climatempo->current($mesquita);
*/

            $client = new GuzzleHttp\Client();
            
            $res = $client->request("GET", "http://apiadvisor.climatempo.com.br/api/v1/weather/locale/6135/current?token=a7d6291b515e2018ac998839ba254b7a");

            // Salvar ao resultado da chamada
            $resposta = json_decode($res->getBody()->getContents());

            $temperatura = new Temperatura;

            $temperatura->temperature     = $resposta->data->temperature;
            $temperatura->wind_direction  = $resposta->data->wind_direction;
            $temperatura->wind_velocity   = $resposta->data->wind_velocity;
            $temperatura->humidity        = $resposta->data->humidity;
            $temperatura->condition       = $resposta->data->condition;
            $temperatura->pressure        = $resposta->data->pressure;
            $temperatura->icon            = $resposta->data->icon;
            $temperatura->sensation       = $resposta->data->sensation;

            $temperatura->save();

        //})->everyMinute();
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
