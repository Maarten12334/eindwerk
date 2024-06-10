@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Itineraries') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-softWhite dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-primaryGreen dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-secondaryGreen dark:text-gray-100">
                            <h4 class="mb-4 text-xl">My Itineraries</h4>
                            @if ($itineraries->isEmpty())
                            <p>No itineraries found.</p>
                            @else
                            <table class="min-w-full bg-primaryGreen dark:bg-gray-800">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Name</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Departure</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Return</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Flight ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itineraries as $itinerary)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            <a href="{{ route('itineraries.show', $itinerary->id) }}" class="text-blue-500 hover:underline">
                                                {{ $itinerary->name }}
                                            </a>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $itinerary->departure }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $itinerary->return }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $itinerary->flight_id }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('itineraries.create') }}"><button class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Create itinerary</button></a>
            </div>
        </div>
    </div>
</div>
@endsection