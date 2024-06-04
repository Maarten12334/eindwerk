<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AmadeusService;

class Flights extends Component
{
    public $flightSchedule;
    public $airlineNames;


    protected $amadeusService;

    public function render()
    {
        return view('livewire.flights');
    }
}
