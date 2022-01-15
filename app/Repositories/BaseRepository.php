<?php

namespace App\Repositories;

class BaseRepository
{
    /**
     * Sending Request to API
     * 
     * @param
     * @return
     * 
     */
    public function apiRequest($sUrl, $sRequestType) {

        $client = new \GuzzleHttp\Client();

        $request = new \GuzzleHttp\Psr7\Request($sRequestType, $sUrl);

        $promise = $client->sendAsync($request)->then(function ($response) {
            return  $response->getBody();
        });

        return $promise->wait();
    }
}
