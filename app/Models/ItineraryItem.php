<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_id',
        'date',
        'type',
        'time',
    ];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
}
