@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Flights') }}
</h2>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4 dark:text-white">Search Flights</h1>
    <form action="{{ route('flights.results') }}" method="GET">
        <div class="form-group mb-6">
            <label for="origin" class="block mb-2 dark:text-white">Origin</label>
            <input type="text" name="origin" id="origin" class="form-control w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="form-group mb-6">
            <label for="destination" class="block mb-2 dark:text-white">Destination</label>
            <input type="text" name="destination" id="destination" class="form-control w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="form-group mb-6 flex space-x-4">
            <div class="w-1/2">
                <label for="departureDate" class="block mb-2 dark:text-white">Departure Date</label>
                <input type="date" name="departureDate" id="departureDate" class="form-control w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="w-1/2">
                <label for="returnDate" class="block mb-2 dark:text-white">Return Date</label>
                <input type="date" name="returnDate" id="returnDate" class="form-control w-full p-2 border border-gray-300 rounded">
            </div>
        </div>
        <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Search</button>
    </form>
</div>
@endsection