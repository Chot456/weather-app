<?php

namespace App\Repositories\OpenWeather;

use App\Repositories\BaseRepository;

class OpenWeatherRepository extends BaseRepository
{
    public function index(string $city) {
        $sUrl = 'https://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.env('API_KEY', '').'&units=metric';
       
        $sRequestType = 'GET';

        return $this->apiRequest($sUrl, $sRequestType);
    }
}
