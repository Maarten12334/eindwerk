<?php

namespace App\Livewire;

use Livewire\Component;

class SearchFlightButton extends Component
{
    public $itinerary;

    public function mount($itinerary)
    {
        $this->itinerary = $itinerary;
    }

    public function render()
    {
        if (!isset($this->itinerary->flight_id)) {
            return view('livewire.flights.search-flight-button', ['itinerary' => $this->itinerary]);
        }

        return view('livewire.empty-view'); // Return an empty string or null when flight_id is not set
    }
}
