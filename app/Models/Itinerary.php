<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'departure',
        'return',
        'flight_id',
        'user_id',
        'random_key',
    ];

    public function items()
    {
        return $this->hasMany(ItineraryItem::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($itinerary) {
            $itinerary->random_key = Str::random(16);
        });
    }
}
