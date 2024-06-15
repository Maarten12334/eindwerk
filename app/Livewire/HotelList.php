<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GooglePlacesService;

class HotelList extends Component
{
    public $city;
    public $radius;
    public $itinerary;
    public $checkInDate;
    public $checkOutDate;
    protected $googlePlaces;

    public function mount(GooglePlacesService $googlePlaces, $city, $radius, $itinerary, $checkInDate, $checkOutDate)
    {
        $this->googlePlaces = $googlePlaces;
        $this->city = $city;
        $this->radius = $radius;
        $this->itinerary = $itinerary;
        $this->checkInDate = $checkInDate;
        $this->checkOutDate = $checkOutDate;
    }

    public function render()
    {
        $hotels = $this->googlePlaces->googlePlacesCall($this->city, $this->radius);
        return view('livewire.hotels.hotel-list', ['hotels' => $hotels]);
    }
}
