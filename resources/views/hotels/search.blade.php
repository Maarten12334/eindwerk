@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Hotels by City') }}
</h2>
@endsection

@section('content')

<body>
    <h1>Search for Hotels</h1>
    <form action="{{ route('hotels.apiRequest') }}" method="GET" id="hotelSearchForm">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br><br>
        <label for="radius">Radius (meters):</label>
        <input type="number" id="radius" name="radius" value="5000"><br><br>
        <button type="submit">Search</button>
    </form>
</body>

@endsection