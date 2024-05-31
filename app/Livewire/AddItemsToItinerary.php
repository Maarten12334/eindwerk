<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ItineraryItem;

class AddItemsToItinerary extends Component
{
    public $current_date;
    public $itinerary_id;
    public $newItem;
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
        ]);

        ItineraryItem::create([
            'itinerary_id' => $this->itinerary_id,
            'date' => $this->current_date,
            'type' => $this->newItem,
            'description' => '',
        ]);

        $this->resetInput();
        $this->emit('refreshComponent');
    }

    public function editItem($itemId)
    {
        $item = ItineraryItem::findOrFail($itemId);
        $this->editItem = $item;
        $this->newItem = $item->type;
        $this->buttonClicked = true;
        $this->message = 'Edit Item';
    }

    public function updateItem()
    {
        $this->validate([
            'newItem' => 'required|string|max:255',
        ]);

        if ($this->editItem) {
            $item = ItineraryItem::findOrFail($this->editItem->id);
            $item->update([
                'type' => $this->newItem,
            ]);
            $this->resetInput();
            $this->emit('refreshComponent');
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
        $this->buttonClicked = false;
        $this->editItem = null;
        $this->message = 'Add Item';
    }

    public function render()
    {
        return view('livewire.add-items-to-itinerary');
    }
}
