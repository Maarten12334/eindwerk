<?php

namespace App\Livewire\flights;

use Livewire\Component;
use App\Services\AmadeusService;
use Livewire\Attributes\Lazy;

#[Lazy]
class ShowFlights extends Component
{
    public $nonStop;
    public $origin;
    public $destination;
    public $departureDate;
    public $returnDate;
    protected $amadeusService;

    public function mount(AmadeusService $amadeusService, $origin, $destination, $departureDate, $returnDate)
    {
        $this->amadeusService = $amadeusService;
        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
        $this->returnDate = $returnDate;
    }

    public function render()
    {
        // Call the AmadeusService to fetch flight data
        $flights = $this->amadeusService->searchFlights($this->origin, $this->destination, $this->departureDate, $this->returnDate);

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

        return view('livewire.flights.show-flights', [
            'departureFlightsData' => $departureFlightsData,
            'departureAirlineNames' => $departureAirlineNames,
            'returnFlightsData' => $returnFlightsData,
            'airlineNames' => $returnAirlineNames,
            'nonStop' => $this->nonStop
        ]);
    }
}
