<?php

namespace App\Services\FourSquare;

use App\Repositories\FourSquare\FourSquareRepository;
use Illuminate\Support\Facades\Log;

class FourSquareService
{
    private $oFourSquareRepository;

    public function __construct(FourSquareRepository $oFourSquareRepository)
    {
        $this->oFourSquareRepository = $oFourSquareRepository;
    }

    /**
     * Get near by places from API
     * 
     * @param
     * @return
     * 
     */
    public function findNearByPlaces(object $oRequst)
    {
        try {
            return $this->oFourSquareRepository->index($oRequst->LL);
          
          } catch (\Exception $exception) {
                Log::error($exception->getMessage());
                return $exception->getMessage();
        }  
    }
}
