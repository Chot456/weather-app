<?php

namespace App\Http\Controllers\OpenWeather;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpenWeatherRequest;
use App\Services\OpenWeather\OpenWeatherService;

class OpenWeatherController extends Controller
{

    private $oOpenWeatherService;

    public function __construct(OpenWeatherService $oOpenWeatherService)
    {
        $this->oOpenWeatherService = $oOpenWeatherService;
    }

    /**
     * Get weather from API by its city
     * 
     * @param OpenWeatherRequest $oCity
     * @return object
     */
    public function getWeather(OpenWeatherRequest $oCity) 
    {
        $getWeather = $this->oOpenWeatherService->getWeather($oCity);

        return $getWeather;
    }
}
