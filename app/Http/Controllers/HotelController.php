<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmadeusService;

class HotelController extends Controller
{
    protected $amadeusService;

    public function __construct(AmadeusService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function listHotelsByCity(Request $request)
    {
        $cityCode = $request->input('cityCode');
        $radius = $request->input('radius', 5);
        $radiusUnit = $request->input('radiusUnit', 'KM');
        $hotelSource = $request->input('hotelSource', 'ALL');

        $hotels = $this->amadeusService->searchHotelsByCity($cityCode, $radius, $radiusUnit, $hotelSource);

        return view('hotels.search', ['hotels' => $hotels]);
    }

    public function showSearchForm()
    {
        return view('hotels.search');
    }
}
