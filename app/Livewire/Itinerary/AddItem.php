<?php

namespace App\Livewire\Itinerary;

use Livewire\Component;
use App\Models\ItineraryItem;

class AddItem extends Component
{
    public $itinerary_id;
    public $date;
    public $type;
    public $time;

    protected $rules = [
        'type' => 'required|string|max:255',
        'time' => 'required|date_format:H:i',
    ];

    public function mount($itinerary_id, $date)
    {
        $this->itinerary_id = $itinerary_id;
        $this->date = $date;
    }

    public function addItem()
    {
        $this->validate();

        ItineraryItem::create([
            'itinerary_id' => $this->itinerary_id,
            'date' => $this->date,
            'type' => $this->type,
            'time' => $this->time,
        ]);

        // Clear the form fields
        $this->reset(['type', 'time']);

        // Emit an event to refresh the itinerary days component
        $this->emit('itemAdded');
    }

    public function render()
    {
        return view('livewire.itinerary.add-item');
    }
}
