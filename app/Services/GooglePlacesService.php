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

    public function searchNearby($latitude, $longitude, $radius)
    {
        $url = 'https://places.googleapis.com/v1/places:searchNearby';

        // Replace with your actual API key
        $apiKey = $this->apiKey;

        $data = [
            'includedTypes' => ['hotel'],
            'maxResultCount' => 10,
            'locationRestriction' => [
                'circle' => [
                    'center' => [
                        'latitude' => $latitude,
                        'longitude' => $longitude
                    ],
                    'radius' => $radius, // Replace with your desired radius in meters
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Goog-Api-Key' => $apiKey,
            'X-Goog-FieldMask' => ['places.displayName', 'places.formattedAddress', 'places.businessStatus', 'places.id', 'places.priceLevel', 'places.photos', 'places.userRatingCount', 'places.websiteUri', 'places.rating'],
        ])->post($url, $data);



        return $response->json();
    }

    public function getPhotoUrl($photoReference, $maxWidth = 400)
    {
        // Base URL for Google Places photo API
        $baseUrl = "https://maps.googleapis.com/maps/api/place/photo";

        // Replace placeholders with actual values
        $url = "{$baseUrl}?maxwidth={$maxWidth}&photoreference={$photoReference}&key={$this->apiKey}";

        return $url;
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
