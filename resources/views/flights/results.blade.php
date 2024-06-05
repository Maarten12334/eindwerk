@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Flights') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                @if ($returnFlightsData)
                <!-- Check if a returnflight is given -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:pr-3">
                        @livewire('show-flights', ['departureFlightsData' => $departureFlightsData, 'airlineNames' => $departureAirlineNames, 'nonStop' => $nonStop])
                    </div>
                    <div class="md:pl-3">
                        @livewire('show-flights', ['departureFlightsData' => $returnFlightsData, 'airlineNames' => $returnAirlineNames, 'nonStop' => $nonStop])
                    </div>
                </div>
                @else
                <div class="grid grid-cols-1 justify-center">
                    <div class="md:mx-auto">
                        @livewire('show-flights', ['departureFlightsData' => $departureFlightsData, 'airlineNames' => $departureAirlineNames, 'nonStop' => $nonStop])
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection