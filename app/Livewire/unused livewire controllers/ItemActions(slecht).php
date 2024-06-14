<?php

namespace App\Livewire;

use App\Models\ItineraryItem;
use Livewire\Component;

class ItemActions extends Component
{
    public $item;
    public $itemsCount;
    public $current_date;
    public $itinerary_id;
    public $newItem;
    public $newTime;
    public $buttonClicked = false;
    public $editItem;
    public $message = 'Add Item';

    protected $listeners = ['editItem', 'deleteItem'];

    public function mount($item)
    {
        $this->item = $item;
    }

    public function editItem($itemId)
    {
        $item = ItineraryItem::findOrFail($itemId);
        $this->editItem = $item;
        $this->newItem = $item->type;
        $this->newTime = $item->time;
        $this->buttonClicked = true;
    }

    public function deleteItem($itemId)
    {
        $item = ItineraryItem::findOrFail($itemId);
        $item->delete();
    }

    public function render()
    {
        return view('livewire.item-actions');
    }
}
