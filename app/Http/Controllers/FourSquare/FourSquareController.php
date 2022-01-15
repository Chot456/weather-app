<?php

namespace App\Http\Controllers\FourSquare;

use App\Http\Controllers\Controller;
use App\Http\Requests\FourSquare\FourSquareRequest;
use App\Services\FourSquare\FourSquareService;

class FourSquareController extends Controller
{
    private $oFourSquareService;

    public function __construct(FourSquareService $oFourSquareService)
    {
        $this->oFourSquareService = $oFourSquareService;
    }

    public function findNearByPlaces(FourSquareRequest $oRequest)
    {
        $findNearByPlaces = $this->oFourSquareService->findNearByPlaces($oRequest);

        return $findNearByPlaces;
    }
}
