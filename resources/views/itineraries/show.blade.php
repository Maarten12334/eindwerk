@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Itinerary Details') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-secondaryGreen dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-secondaryGreen dark:text-gray-100">
                <h4 class="mb-4 text-2xl font-bold text-primaryGreen">{{ $itinerary->name }}</h4>
                @livewire('itinerary.itinerary-days', [
                'itinerary' => $itinerary,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'items_by_date' => $items_by_date
                ])
            </div>
            <div class="mt-6">
                <a href="{{ route('itineraries.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">My itineraries</a>
                <a href="{{ route('itineraries.edit', $itinerary->id) }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 ml-4 rounded">Edit itinerary</a>
                <a href="{{ route('hotels.search', $itinerary) }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 ml-4 rounded">Zoek een hotel</a>
                @livewire('SearchFlightButton', ['itinerary' => $itinerary])
                <a href="{{ route('itineraries.pdf', $itinerary) }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 ml-4 rounded">Download PDF</a>
            </div>
        </div>
    </div>
</div>
@endsection