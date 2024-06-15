<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Services\GooglePlacesService;


#[Lazy]
class HotelList extends Component
{
    protected $googlePlaces;
    public $city;
    public $radius;
    public $itinerary;
    public $checkInDate;
    public $checkOutDate;

    public function mount(GooglePlacesService $googlePlaces, $city, $radius)
    {
        $this->googlePlaces = $googlePlaces;
        $this->city = $city;
        $this->radius = $radius;
    }

    public function render()
    {
        $hotels = $this->googlePlaces->googlePlacesCall($this->city, $this->radius);
        return view('livewire.hotels.hotel-list', ['hotels' => $hotels]);
    }
}
