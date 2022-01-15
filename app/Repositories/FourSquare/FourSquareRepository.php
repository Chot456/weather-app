<?php

namespace App\Repositories\FourSquare;

use App\Repositories\BaseRepository;

class FourSquareRepository extends BaseRepository
{
    public function index($sll) {
        // dd($sll);
        // $client = new \GuzzleHttp\Client();

        // $response = $client->request('GET', 'https://api.foursquare.com/v3/places/nearby?ll=34.6937%2C135.5023', [
        // 'headers' => [
        //     'Accept' => 'application/json',
        //     'Authorization' => 'fsq3Jh1UWKGNrDCvRpPFCGZRpWYKSUQqSo2OyntIvdiNiJU=',
        // ],
        // ]);

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.foursquare.com/v3/places/nearby?ll='.$sll, [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'fsq3Jh1UWKGNrDCvRpPFCGZRpWYKSUQqSo2OyntIvdiNiJU=',
        ],
        ]);

        echo $response->getBody();
    }
}
