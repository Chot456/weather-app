<?php

namespace App\Repositories\FourSquare;

use App\Repositories\BaseRepository;

class FourSquareRepository extends BaseRepository
{
    public function index($sll) {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.foursquare.com/v3/places/nearby?ll='.$sll, [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => env('FOURSHARE_API_KEY', ''),
        ],
        ]);

        echo $response->getBody();
    }
}
