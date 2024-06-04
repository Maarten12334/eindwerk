<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GooglePlacesService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_PLACES_API_KEY');
    }

    public function searchPlaces($type, $location, $radius)
    {
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
        $response = Http::get($url, [
            'key' => $this->apiKey,
            'location' => implode(',', $location),
            'radius' => $radius,
            'type' => $type
        ]);

        return $response->json()['results'] ?? [];
    }

    public function getPlaceDetails($placeId)
    {
        $url = 'https://maps.googleapis.com/maps/api/place/details/json';
        $response = Http::get($url, [
            'key' => $this->apiKey,
            'place_id' => $placeId
        ]);

        return $response->json()['result'] ?? [];
    }

    public function getCoordinatesFromCity($city)
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json';
        $response = Http::get($url, [
            'key' => $this->apiKey,
            'address' => $city
        ]);

        if ($response->successful() && !empty($response->json()['results'])) {
            $location = $response->json()['results'][0]['geometry']['location'];
            return [$location['lat'], $location['lng']];
        }

        return null;
    }
}
