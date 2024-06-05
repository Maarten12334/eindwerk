@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Hotels by City') }}
</h2>
@endsection

@section('content')

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4 dark:text-white">Search for Hotels</h1>
        <form action="{{ route('hotels.apiRequest') }}" method="GET" id="hotelSearchForm">
            <div class="form-group mb-6">
                <label for="city" class="block mb-2 dark:text-white">City:</label>
                <input type="text" id="city" name="city" class="form-control w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="form-group mb-6">
                <label for="radius" class="block mb-2 dark:text-white">Radius (meters):</label>
                <input type="number" id="radius" name="radius" value="5000" class="form-control w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Search</button>
        </form>
    </div>
</body>

@endsection