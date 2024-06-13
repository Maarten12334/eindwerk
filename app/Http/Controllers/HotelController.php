<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Services\GooglePlacesService;

class HotelController extends Controller
{
    protected $googlePlaces;
    public $itinerary;

    public function __construct(GooglePlacesService $googlePlaces)
    {
        $this->googlePlaces = $googlePlaces;
    }

    //This function is used to pass the itinerary id to the view
    public function search(Itinerary $itinerary = null)
    {
        return view('hotels.search', compact('itinerary'));
    }

    public function apiRequest(Request $request)
    {
        $city = $request->input('city');
        $radius = $request->input('radius', 5000.0);

        $results = $this->googlePlaces->searchHotelsByCity($city, $radius);

        if ($results === null) {
            return response()->json(['error' => 'Unable to fetch places.'], 400);
        }

        return response()->json($results);
    }

    public function getPhoto($photoReference)
    {
        $photo = $this->googlePlaces->getPhotoUrl($photoReference);

        if ($photo) {
            return response($photo)->header('Content-Type', 'image/jpeg');
        }

        return response()->json(['error' => 'Unable to fetch photo.'], 400);
    }

    public function results(Itinerary $itinerary = null, Request $request)
    {
        $city = $request->input('city');
        $radius = $request->input('radius', 5000.0);

        $response = $this->googlePlaces->searchHotelsByCity($city, $radius);

        if ($response === null || !isset($response['places'])) {
            // Handle the case where the response is not as expected
            return view('hotels.results', [
                'hotels' => [],
                'itinerary' => $itinerary,
                'checkInDate' => $request->input('checkInDate'),
                'checkOutDate' => $request->input('checkOutDate'),
                'error' => 'Unable to fetch hotels'
            ]);
        }

        $places = $response['places'];
        $hotels = $places;

        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');

        foreach ($hotels as &$hotel) {
            if (isset($hotel['photos']) && !empty($hotel['photos'])) {
                $photoreference = $hotel['photos'][0]['photo_reference'];
                $hotel['photoUrl'] = $this->googlePlaces->getPhotoUrl($photoreference);
            }
        }

        return view('hotels.results', compact('hotels', 'itinerary', 'checkInDate', 'checkOutDate'));
    }


    public function details(Request $request, $placeId)
    {
        $placeDetails = $this->googlePlaces->getPlaceDetails($placeId);
        return response()->json($placeDetails);
    }
}
