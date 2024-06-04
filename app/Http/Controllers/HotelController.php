<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GooglePlacesService;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    protected $googlePlaces;

    public function __construct(GooglePlacesService $googlePlaces)
    {
        $this->googlePlaces = $googlePlaces;
    }

    public function search()
    {
        return view('hotels.search');
    }


    //Disabled to save money from google places api
    /*public function apiRequest(Request $request)
    {
        $city = $request->input('city');
        $coordinates = $this->googlePlaces->getCoordinatesFromCity($city);
        if ($coordinates) {
            $latitude = $coordinates[0];
            $longitude = $coordinates[1];
        } else {
            return response()->json(['error' => 'Unable to get coordinates.'], 400);
        }
        $radius = $request->input('radius', 5000.0);
        $includedTypes = $request->input('includedTypes', ['restaurant']);

        $results = $this->googlePlaces->searchNearby($latitude, $longitude, $radius, $includedTypes);

        if ($results === null) {
            return response()->json(['error' => 'Unable to fetch places.'], 400);
        }

        return response()->json($results);
    }*/


    public function getPhoto($photoReference)
    {
        $photo = $this->googlePlaces->getPhotoUrl($photoReference);

        if ($photo) {
            return response($photo)->header('Content-Type', 'image/jpeg');
        }

        return response()->json(['error' => 'Unable to fetch photo.'], 400);
    }

    public function returnTestJson()
    {
        $path = storage_path('testingHotels.json');
        if (File::exists($path)) {
            $content = File::get($path);
            $data = json_decode($content, true);

            return response()->json($data);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function results()
    {
        $data = $this->returnTestJson();
        $places = $data->getData();
        $hotels = $places->places;

        foreach ($hotels as $hotel) {
            $photoreference = $hotel->photos[0]->name;
            $hotel->photoUrl = $this->googlePlaces->getPhotoUrl($photoreference);
        }
        return view('hotels.results', compact('hotels'));
    }

    public function details(Request $request, $placeId)
    {
        $placeDetails = $this->googlePlaces->getPlaceDetails($placeId);
        return response()->json($placeDetails);
    }
}
