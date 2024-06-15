<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Hotel;


class HotelController extends Controller
{
    public $itinerary;

    public function search(Itinerary $itinerary = null)
    {
        return view('hotels.search', compact('itinerary'));
    }

    public function results(Itinerary $itinerary = null, Request $request)
    {
        $city = $request->input('city');
        $radius = $request->input('radius');

        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');

        return view('hotels.results', compact('city', 'radius', 'itinerary', 'checkInDate', 'checkOutDate'));
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->back()->with('success', 'Hotel deleted successfully.');
    }
}
