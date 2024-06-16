<?php

namespace App\Livewire\Flights;

use Livewire\Component;

class Flights extends Component
{
    public $flightSchedule;
    public $airlineNames;


    protected $amadeusService;

    public function render()
    {
        return view('livewire.flights.flights');
    }
}
