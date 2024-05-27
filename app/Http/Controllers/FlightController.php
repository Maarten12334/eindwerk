<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function search()
    {
        return view('flights.search');
    }

    public function results(Request $request)
    {
        // Logic for fetching flight results
        // $flights = ...

        return view('flights.results', compact('flights'));
    }
}
