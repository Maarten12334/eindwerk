<?php

namespace App\Livewire\Itinerary;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Itinerary;
use App\Models\ItineraryItem;
use App\Models\Hotels;

class ItineraryDays extends Component
{
    public $itinerary;
    public $start_date;
    public $end_date;
    public $items_by_date;

    public $type = [];
    public $time = [];
    public $current_date;

    protected $rules = [
        'type.*' => 'required|string|max:255',
        'time.*' => 'required|date_format:H:i',
    ];

    public function mount(Itinerary $itinerary, $start_date, $end_date, $items_by_date)
    {
        $this->itinerary = $itinerary;
        $this->start_date = Carbon::parse($start_date);
        $this->end_date = Carbon::parse($end_date);
        $this->items_by_date = collect($items_by_date);
    }

    public function addItem($date)
    {
        $this->validate();

        ItineraryItem::create([
            'itinerary_id' => $this->itinerary->id,
            'date' => $date,
            'type' => $this->type[$date],
            'time' => $this->time[$date],
        ]);

        // Refresh items by date
        $this->items_by_date = $this->itinerary->items()->orderBy('date')->get()->groupBy('date')->toArray();

        // Clear the form fields
        unset($this->type[$date], $this->time[$date]);
    }

    public function deleteItem($itemId)
    {
        $item = ItineraryItem::findOrFail($itemId);
        $item->delete();

        // Refresh items by date
        $this->items_by_date = $this->itinerary->items()->orderBy('date')->get()->groupBy('date')->toArray();
    }

    public function render()
    {
        return view('livewire.itinerary.itinerary-days');
    }
}
