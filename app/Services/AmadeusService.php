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
        try {
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
        } catch (RequestException $e) {
            // Log the error or handle it as necessary
            return null;
        }
    }

    public function searchFlights($origin, $destination, $departureDate, $returnDate = null)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return [
                'error' => 'Unable to retrieve access token.',
                'departureFlights' => null,
                'returnFlights' => null,
            ];
        }

        // Search for departure flights
        $departureFlights = $this->fetchFlights($origin, $destination, $departureDate, $accessToken);

        // Search for return flights if returnDate is provided
        $returnFlights = $returnDate ? $this->fetchFlights($destination, $origin, $returnDate, $accessToken) : null;

        return [
            'departureFlights' => $departureFlights,
            'returnFlights' => $returnFlights,
        ];
    }

    private function fetchFlights($origin, $destination, $date, $accessToken)
    {
        try {
            $response = $this->client->get($this->baseUri . '/v2/shopping/flight-offers', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'query' => [
                    'originLocationCode' => $origin,
                    'destinationLocationCode' => $destination,
                    'departureDate' => $date,
                    'adults' => 1,
                    'max' => 10,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Log the error or handle it as necessary
            return [
                'error' => 'Unable to fetch flights.',
                'data' => [],
                'dictionaries' => ['carriers' => []],
            ];
        }
    }
}
