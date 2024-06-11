<?php

namespace App\Livewire\Itinerary;

use Livewire\Component;

class Item extends Component
{
    public $item;

    public function mount($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.itinerary.item');
    }
}
