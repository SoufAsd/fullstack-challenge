<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Weather;
use App\Repositories\WeatherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Http;

class fetchApi extends Command
{
    protected $WeatherRepository;

    public function __construct(WeatherRepository $WeatherRepository) {
        parent::__construct();
        $this->WeatherRepository = $WeatherRepository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:weather {lat} {long} {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $lat = $this->argument('lat');
        $long = $this->argument('long');
        $user_id = $this->argument('user_id');

        $user = User::find($user_id);

        $weather = $this->WeatherRepository->make();

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $long . '&appid=0d09d77c4d160a65cda1ed4ebec896b3');

        if($response->ok()){
            $weather->setWeather($response->json("weather")[0]['description']);
            $weather->setTemperature($response->json("main")['temp']);
            $weather->setHumidity($response->json("main")['humidity']);
            $weather->setWind($response->json("wind")['speed']);
            $weather->setUser($user);
    
            $this->WeatherRepository->save($weather);

            $mqtt = MQTT::connection();
            $mqtt->publish('websocket/apiweatherget', $weather, 1);
        }
    }
}
