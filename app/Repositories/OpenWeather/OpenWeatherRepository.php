<?php

namespace App\Repositories\OpenWeather;

use App\Constants\OpenWeather\OpenWeatherConstants;
use App\Repositories\BaseRepository;

class OpenWeatherRepository extends BaseRepository
{
    public function index(string $city) {
        $sUrl = 'https://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.env('API_KEY', 'a630321d5ae11ca41ba3057282d1485a').'&units=metric';
        // $sUrl =  OpenWeatherConstants::OPEN_WEATHER_BASE_URI.'/data/2.5/weather?q='.$city.'&appid='.env('API_KEY', 'a630321d5ae11ca41ba3057282d1485a').'&units=metric';
       
        $sRequestType = 'GET';

        return $this->apiRequest($sUrl, $sRequestType);
    }
}
