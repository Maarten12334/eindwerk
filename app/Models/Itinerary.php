<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'departure',
        'return',
        'flight_id',
        'user_id',
    ];

    public function items()
    {
        return $this->hasMany(ItineraryItem::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
