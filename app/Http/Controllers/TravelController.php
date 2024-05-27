<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmadeusService;

class TravelController extends Controller
{
    protected $amadeusService;

    public function __construct(AmadeusService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function searchFlights(Request $request)
    {
        $origin = $request->input('origin', 'LON');
        $destination = $request->input('destination', 'NYC');
        $departureDate = $request->input('departureDate', '2024-12-25');

        $flights = $this->amadeusService->searchFlights($origin, $destination, $departureDate);
        return view('flights', compact('flights'));
    }
}
