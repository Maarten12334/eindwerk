<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AmadeusService
{
    protected $client;
    protected $baseUri;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUri = config('services.amadeus.url', 'https://test.api.amadeus.com');
    }

    public function getAccessToken()
    {
        $apiKey = config('services.amadeus.key');
        $apiSecret = config('services.amadeus.secret');

        $response = $this->client->post($this->baseUri . '/v1/security/oauth2/token', [
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

        $response = $this->client->get($this->baseUri . '/v2/shopping/flight-offers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
            'query' => [
                'originLocationCode' => $origin,
                'destinationLocationCode' => $destination,
                'departureDate' => $departureDate,
                'adults' => 1,
                'max' => 10,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
