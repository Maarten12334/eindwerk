<?php

namespace App\Services;

use GuzzleHttp\Client;

class AmadeusService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAccessToken()
    {
        $apiKey = config('services.amadeus.key');
        $apiSecret = config('services.amadeus.secret');

        $response = $this->client->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $apiKey,
                'client_secret' => $apiSecret,
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        return $data['access_token'];
    }

    public function searchFlights($origin, $destination, $departureDate)
    {
        $accessToken = $this->getAccessToken();

        $response = $this->client->get('https://test.api.amadeus.com/v2/shopping/flight-offers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
            'query' => [
                'originLocationCode' => $origin,
                'destinationLocationCode' => $destination,
                'departureDate' => $departureDate,
                'adults' => 1,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
