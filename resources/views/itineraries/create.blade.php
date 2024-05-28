@extends('layouts.app')

<head>
    <title>Create Itinerary</title>
</head>

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Hotels by City') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('itineraries.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-6">
                        <label for="itineraryName" class="block mb-2 dark:text-white">Itinerary Name</label>
                        <input type="text" name="name" id="itineraryName" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="departureDate" class="block mb-2 dark:text-white">Departure date</label>
                        <input type="date" name="departure" id="departureDate" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="returnDate" class="block mb-2 dark:text-white">Return Date</label>
                        <input type="date" name="return" id="returnDate" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                    </div>
                    <div class="form-group mb-6">
                        <label for="flightId" class="block mb-2 dark:text-white">Flight id (optional)</label>
                        <input type="text" name="flight_id" id="flightId" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded">
                    </div>
                    <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Create Itinerary</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection