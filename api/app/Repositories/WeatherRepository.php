<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\Weather;

class WeatherRepository
{
    /**
     * @param array $data
     * @return Weather
     */
    public function make($data = []): Weather
    {
        return new Weather($data);
    }

    /**
     * @param Weather $weather
     * @return Weather
     * @throws \Exception
     */
    public function save(Weather $weather): Weather
    {
        try {
            $weather->save();
        } catch (\Exception $exception) {
            throw $exception;
        }

        $weather->refresh();

        return $weather;
    }

    /**
     * @param int $id
     * @return weather|null
     */
    public function findById(int $id): ?weather
    {
        return weather::where('id', $id)->first();
    }

     /**
     * @param int $user_id
     * @return weather|null
     */
    public function findByIdUser(int $user_id): ?weather
    {
        return weather::where('user_id', $user_id)->orderby('created_at', 'desc')->first();
    }
}
