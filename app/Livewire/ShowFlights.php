<?php

namespace App\Livewire;

use Livewire\Component;

class ShowFlights extends Component
{
    public $departureFlightsData;
public $nonStop;
public $airlineNames;

    public function render()
    {
        return view('livewire.show-flights');
    }
}
