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

        $departureFlights = $this->flightsApiCall($origin, $destination, $departureDate); //Returns list of flights from $origin to $destination on $departureDate
        if(isset($returnDate)){
            $returnFlights = $this->flightsApiCall($destination, $origin, $returnDate); //Returns list of flights from $destination to $origin on $returnDate if returndate isset
            $returnFlightsData = $returnFlights['data'];
        } else {
            $returnFlightsData = false;
        }
        $departureFlightsData = $departureFlights['data'];

        $airlineNames = $departureFlights['dictionaries']['carriers']; //Returns list of airline names

        return view('flights.results', compact('returnFlightsData', 'departureFlightsData', 'airlineNames', 'nonStop'));
    }

    public Function flightsApiCall($origin, $destination, $departureDate){

        $flights = $this->amadeusService->searchFlights($origin, $destination, $departureDate);
        return $flights;
    }



    public function search()
    {
        return view('flights.search');
    }
}
