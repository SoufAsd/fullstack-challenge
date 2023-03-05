<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\WeatherRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Exception;

class WeatherController extends Controller
{
    protected $WeatherRepository;
    
    public function __construct(WeatherRepository $WeatherRepository) {
        $this->WeatherRepository = $WeatherRepository;
    }

    /**
     * @return jsonResponse
     */
    public function index()
    {
        $weathers = array();
        $users = array();
        User::all()->each(function($user,$index) use(&$users,&$weathers){
            $users[] = $user;
            $weathers[] = $this->WeatherRepository->findByIdUser($user->getId());
        });

        return response()->json([
            'users' => $users,
            'weather' => $weathers
        ]);
    }

    /**
     * @param int $user_id
     * @return jsonResponse
     */
    public function getWeatherHistory(int $user_id){

        $weather = $this->WeatherRepository->findByIdUser($user_id);

        return response()->json([
            'details' => $weather
        ]);
    }
}
