<?php

namespace App\Services\OpenWeather;

use App\Repositories\OpenWeather\OpenWeatherRepository;
use Illuminate\Support\Facades\Log;

class OpenWeatherService
{
    private $oOpenWeatherRepository;

    public function __construct(OpenWeatherRepository $oOpenWeatherRepository)
    {
        $this->oOpenWeatherRepository = $oOpenWeatherRepository;
    }

    /**
     * Get Weather Details by its city
     * 
     * @param object $oRequst
     * @return mixed
     * 
     */
    public function getWeather(object $oRequst)
    {
        try {
            return $this->oOpenWeatherRepository->index($oRequst->city);
          
          } catch (\Exception $exception) {
                Log::error($exception->getMessage());
                return $exception->getMessage();
        }        
    }
}
