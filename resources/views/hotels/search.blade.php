@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Hotels by City') }}
</h2>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4 dark:text-white">Search Hotels by City</h1>
    <form action="{{ route('hotels.search') }}" method="GET">
        <div class="form-group mb-6">
            <label for="cityCode" class="block mb-2 dark:text-white">City Code</label>
            <input type="text" name="cityCode" id="cityCode" class="form-control w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="form-group mb-6">
            <label for="radius" class="block mb-2 dark:text-white">Radius</label>
            <input type="number" name="radius" id="radius" class="form-control w-full p-2 border border-gray-300 rounded" value="5" required>
        </div>
        <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Search</button>
    </form>

    @if(isset($hotels))
    <h2 class="text-xl font-bold mb-4 dark:text-white">Hotel Results</h2>
    @foreach ($hotels['data'] as $hotel)
    <div class="hotel mb-4 p-4 border border-gray-300 rounded dark:text-white">
        <h3 class="font-bold">{{ $hotel['name'] }}</h3>

    </div>
    @endforeach
    @endif
</div>
@endsection