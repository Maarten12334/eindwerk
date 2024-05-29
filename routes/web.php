<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\ItineraryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CityController;


// Home
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes are provided by Breeze
require __DIR__ . '/auth.php';

// Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Flight Search
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

    // Profile
    Route::get('/profile', function () {
        // Assuming you have a profile controller and view
        return view('profile');
    })->name('profile');

    // Notifications
    Route::get('/notifications', function () {

        return view('notifications');
    })->name('notifications');


    //Hotels
    Route::get('/hotels', [HotelController::class, 'showSearchForm'])->name('hotels.search');
    Route::get('/hotels/results', [HotelController::class, 'listHotelsByCity'])->name('hotels.results');
});
