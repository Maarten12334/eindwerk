<?php

namespace App\Livewire;

use Livewire\Component;

class AddItemsToItinerary extends Component
{
    public $current_date;
    public $message = 'Click the button';
    public function render()
    {
        return view('livewire.add-items-to-itinerary');
    }

    public function addItem()
    {
        $this->message = 'Button has been clicked';
    }
}
