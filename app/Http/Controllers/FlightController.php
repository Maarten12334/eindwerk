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
        $returnDate = $request->input('returnDate', '2024-12-25');
        $nonStop = $request->input('nonStop');

        // Call the AmadeusService to fetch flight data
        $flights = $this->amadeusService->searchFlights($origin, $destination, $departureDate, $returnDate);

        if (isset($flights['error'])) {
            // Handle the error (e.g., display an error message)
            return view('flights.results', [
                'error' => $flights['error'],
                'departureFlightsData' => null,
                'departureAirlineNames' => null,
                'returnFlightsData' => null,
                'returnAirlineNames' => null,
                'nonStop' => $nonStop
            ]);
        }

        $departureFlightsData = $flights['departureFlights']['data'] ?? [];
        $departureAirlineNames = $flights['departureFlights']['dictionaries']['carriers'] ?? [];

        $returnFlightsData = $flights['returnFlights']['data'] ?? [];
        $returnAirlineNames = $flights['returnFlights']['dictionaries']['carriers'] ?? [];

        return view('flights.results', compact('returnFlightsData', 'departureFlightsData', 'departureAirlineNames', 'returnAirlineNames', 'nonStop'));
    }

    public function search()
    {
        return view('flights.search');
    }
}
