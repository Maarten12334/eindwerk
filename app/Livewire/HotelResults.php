<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GooglePlacesService;

class HotelResults extends Component
{

    protected $googlePlaces;

    public function __construct(GooglePlacesService $googlePlaces)
    {
        $this->googlePlaces = $googlePlaces;
    }

    public function render()
    {
        return view('livewire.hotels.hotel-results');
    }
}
