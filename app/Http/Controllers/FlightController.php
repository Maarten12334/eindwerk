<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightController extends Controller
{


    public function results(Request $request)
    {
        $origin = $request->input('origin', 'LON');
        $destination = $request->input('destination', 'NYC');
        $departureDate = $request->input('departureDate', '2024-12-25');
        $returnDate = $request->input('returnDate', '2024-12-25');
        $nonStop = $request->input('nonStop');

        return view('flights.results', compact('origin', 'destination', 'departureDate', 'returnDate', 'nonStop'));
    }

    public function search()
    {
        return view('flights.search');
    }
}
