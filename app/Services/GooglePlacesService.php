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

        $apiKey = $this->apiKey;

        $data = [
            'includedTypes' => ['hotel'],
            'maxResultCount' => 20,
            'locationRestriction' => [
                'circle' => [
                    'center' => [
                        'latitude' => $latitude,
                        'longitude' => $longitude
                    ],
                    'radius' => $radius,
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

    public function googlePlacesCall($city, $radius)
    {
        $coordinates = $this->getCoordinatesFromCity($city);
        if (!$coordinates) {
            return ['error' => 'Unable to get coordinates.'];
        }

        $latitude = $coordinates[0];
        $longitude = $coordinates[1];

        $results = $this->searchNearby($latitude, $longitude, $radius);

        if (isset($results['error'])) {
            return $results;
        }

        $places = $results['places'] ?? [];

        foreach ($places as &$place) {
            $photoReference = $place['photos'][0]['name'] ?? null;
            if ($photoReference) {
                $place['photoUrl'] = $this->getPhotoUrl($photoReference);
            }
        }

        return $places;
    }


    public function getPhotoUrl($photoReference, $maxWidth = 400)
    {
        // Find the position of "photos/" in the URL
        $pos = strpos($photoReference, 'photos/');

        // If "photos/" is found, return the substring after it
        if ($pos !== false) {
            $photoReference = substr($photoReference, $pos + strlen('photos/'));
        }

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
