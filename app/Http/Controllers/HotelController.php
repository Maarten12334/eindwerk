<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Hotel; // Make sure to import the Hotel model
use App\Services\GooglePlacesService;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    protected $googlePlaces;
    public $itinerary;

    public function __construct(GooglePlacesService $googlePlaces)
    {
        $this->googlePlaces = $googlePlaces;
    }

    public function search(Itinerary $itinerary = null)
    {
        return view('hotels.search', compact('itinerary'));
    }

    public function results(Itinerary $itinerary = null, Request $request)
    {
        $city = $request->input('city');
        $radius = $request->input('radius');

        $hotels = $this->googlePlaces->googlePlacesCall($city, $radius);

        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');

        return view('hotels.results', compact('hotels', 'itinerary', 'checkInDate', 'checkOutDate'));
    }

    public function details($placeId)
    {
        $placeDetails = $this->googlePlaces->getPlaceDetails($placeId);
        return response()->json($placeDetails);
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->back()->with('success', 'Hotel deleted successfully.');
    }
}
