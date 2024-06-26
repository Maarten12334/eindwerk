<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\ItineraryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\HotelController;

// Home
Route::get('/', function () {
    return redirect()->route('itineraries.index');
});

// Authentication routes are provided by Breeze
require __DIR__ . '/auth.php';

// Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('itineraries.index');
    })->name('dashboard');

    // Flights
    Route::get('/flights/search', [FlightController::class, 'search'])->name('flights.search');
    Route::get('/flights/results', [FlightController::class, 'results'])->name('flights.results');
    Route::get('/flights', [TravelController::class, 'searchFlights']);

    // Itineraries
    Route::get('/itineraries', [ItineraryController::class, 'index'])->name('itineraries.index');
    Route::get('/itineraries/create', [ItineraryController::class, 'create'])->name('itineraries.create');
    Route::post('/itineraries', [ItineraryController::class, 'store'])->name('itineraries.store');
    Route::get('/itineraries/{id}', [ItineraryController::class, 'show'])->name('itineraries.show');
    Route::get('/itineraries/{id}/edit', [ItineraryController::class, 'edit'])->name('itineraries.edit');
    Route::put('/itineraries/{id}', [ItineraryController::class, 'update'])->name('itineraries.update');
    Route::delete('/itineraries/{id}', [ItineraryController::class, 'destroy'])->name('itineraries.destroy');
    Route::post('/itineraries/{itinerary?}/add-hotel', [ItineraryController::class, 'addHotel'])->name('itinerary.addHotel');
    Route::get('/itineraries/{itinerary}/pdf', [ItineraryController::class, 'downloadPDF'])->name('itineraries.pdf');

    // Hotels
    Route::get('/hotels/search/{itinerary?}', [HotelController::class, 'search'])->name('hotels.search');
    Route::get('/hotels/results', [HotelController::class, 'results'])->name('hotels.apiRequest');
    Route::get('/hotels/results/{itinerary?}', [HotelController::class, 'results'])->name('hotels.results');
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    // Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Notifications
    Route::get('/notifications', function () {

        return view('notifications');
    })->name('notifications');
});

Route::get('/{random_key}', [ItineraryController::class, 'visit'])->name('visit');
