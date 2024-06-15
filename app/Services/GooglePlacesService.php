<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GooglePlacesService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_PLACES_API_KEY');
    }

    public function searchNearby($latitude, $longitude, $radius)
    {
        try {
            $url = 'https://places.googleapis.com/v1/places:searchNearby';

            $data = [
                'includedTypes' => ['hotel'],
                'maxResultCount' => 20,
                'locationRestriction' => [
                    'circle' => [
                        'center' => [
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                        ],
                        'radius' => $radius,
                    ],
                ],
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => ['places.displayName', 'places.formattedAddress', 'places.businessStatus', 'places.id', 'places.priceLevel', 'places.photos', 'places.userRatingCount', 'places.websiteUri', 'places.rating'],
            ])->post($url, $data);

            if ($response->successful()) {
                return $response->json();
            } else {
                throw new Exception('Failed to fetch nearby places.');
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function googlePlacesCall($city, $radius)
    {
        try {
            $coordinates = $this->getCoordinatesFromCity($city);
            if (!$coordinates) {
                throw new Exception('Unable to get coordinates.');
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
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getPhotoUrl($photoReference, $maxWidth = 400)
    {
        try {
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
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getPlaceDetails($placeId)
    {
        try {
            $url = 'https://maps.googleapis.com/maps/api/place/details/json';
            $response = Http::get($url, [
                'key' => $this->apiKey,
                'place_id' => $placeId,
            ]);

            if ($response->successful()) {
                return $response->json()['result'] ?? [];
            } else {
                throw new Exception('Failed to fetch place details.');
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getCoordinatesFromCity($city)
    {
        try {
            $url = 'https://maps.googleapis.com/maps/api/geocode/json';
            $response = Http::get($url, [
                'key' => $this->apiKey,
                'address' => $city,
            ]);

            if ($response->successful() && !empty($response->json()['results'])) {
                $location = $response->json()['results'][0]['geometry']['location'];
                return [$location['lat'], $location['lng']];
            } else {
                throw new Exception('Failed to fetch coordinates.');
            }
        } catch (Exception $e) {
            return null;
        }
    }
}
