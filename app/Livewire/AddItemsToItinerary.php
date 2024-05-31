<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ItineraryItem;
use Carbon\Carbon;

class AddItemsToItinerary extends Component
{
    public $current_date;
    public $itinerary_id;
    public $newItem;
    public $newTime;
    public $buttonClicked = false;
    public $editItem;
    public $message = 'Add Item';

    protected $listeners = ['editItem', 'deleteItem'];

    public function addItem()
    {
        $this->buttonClicked = true;
    }

    public function saveItem()
    {
        $this->validate([
            'newItem' => 'required|string|max:255',
            'newTime' => 'required|date_format:H:i',
        ]);

        ItineraryItem::create([
            'itinerary_id' => $this->itinerary_id,
            'date' => Carbon::parse($this->current_date),
            'time' => $this->newTime,
            'type' => $this->newItem,
        ]);

        $this->resetInput();
    }

    public function editItem($itemId)
    {
        $item = ItineraryItem::findOrFail($itemId);
        $this->editItem = $item;
        $this->newItem = $item->type;
        $this->newTime = $item->time;
        $this->buttonClicked = true;
        $this->message = 'Edit Item';
    }

    public function updateItem()
    {
        $this->validate([
            'newItem' => 'required|string|max:255',
            'newTime' => 'required|date_format:H:i',
        ]);

        if ($this->editItem) {
            $item = ItineraryItem::findOrFail($this->editItem->id);
            $item->update([
                'type' => $this->newItem,
                'date' => Carbon::parse($this->current_date),
                'time' => $this->newTime,
            ]);
            $this->resetInput();
        }
    }

    public function deleteItem($itemId)
    {
        $item = ItineraryItem::findOrFail($itemId);
        $item->delete();
        $this->emit('refreshComponent');
    }

    private function resetInput()
    {
        $this->newItem = '';
        $this->newTime = '';
        $this->buttonClicked = false;
        $this->editItem = null;
        $this->message = 'Add Item';
    }

    public function render()
    {
        return view('livewire.add-items-to-itinerary');
    }
}
