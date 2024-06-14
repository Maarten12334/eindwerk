<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_id',
        'name',
        'address',
        'arrival',
        'departure',
    ];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
}
