<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ItineraryItem;
use Carbon\Carbon;

class AddItemsToItinerary extends Component
{
    public $current_date;
    public $message = 'Add Items';
    public $buttonClicked = false;
    public $newItem = '';
    public $itinerary_id;

    public function render()
    {
        return view('livewire.add-items-to-itinerary');
    }

    public function addItem()
    {
        $this->buttonClicked = true;
    }

    public function saveItem()
    {
        // Validate the input
        $this->validate([
            'newItem' => 'required|string|max:255',
        ]);

        $formattedDate = Carbon::parse($this->current_date)->format('Y-m-d');

        // Save the item to the itinerary items table
        ItineraryItem::create([
            'date' => $formattedDate,
            'type' => $this->newItem,
            'itinerary_id' => $this->itinerary_id
        ]);

        // Reset the input field and button state
        $this->newItem = '';
        $this->buttonClicked = false;

        // You can add additional steps here if needed (e.g., refresh the items list)
    }
}
