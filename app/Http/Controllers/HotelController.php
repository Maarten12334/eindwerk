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

    public function apiRequest(Request $request)
    {
        $city = $request->input('city');
        $radius = $request->input('radius', 5000);
        $type = 'hotel';

        $coordinates = $this->googlePlaces->getCoordinatesFromCity($city);
        if ($coordinates) {
            $places = $this->googlePlaces->searchPlaces($type, $coordinates, $radius);
            return response()->json($places);
        } else {
            return response()->json(['error' => 'Unable to get coordinates.'], 400);
        }
    }

    public function returnTestJson(Request $request)
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

    public function details(Request $request, $placeId)
    {
        $placeDetails = $this->googlePlaces->getPlaceDetails($placeId);
        return response()->json($placeDetails);
    }
}
