<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmadeusService;

class FlightController extends Controller
{
    protected $amadeusService;

    public function __construct(AmadeusService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function results(Request $request)
    {
        $origin = $request->input('origin', 'LON');
        $destination = $request->input('destination', 'NYC');
        $departureDate = $request->input('departureDate', '2024-12-25');

        $flights = $this->amadeusService->searchFlights($origin, $destination, $departureDate);
        return view('flights.results', compact('flights'));
    }

    public function search()
    {
        return view('flights.search');
    }
}
