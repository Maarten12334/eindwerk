@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">

</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h4 class="mb-4 text-xl">{{ $itinerary->name }}</h4>
                @php
                $current_date = $start_date->copy();
                $counter = 0;
                @endphp
                <div class="flex flex-wrap -mx-4">
                    @while ($current_date->lte($end_date))
                    <div class="w-full md:w-1/2 px-4 mb-6 {{ $counter % 2 == 0 ? 'md:self-start' : 'md:self-end' }}">
                        <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md">
                            <h5 class="text-lg font-semibold">{{ $current_date->format('d-m') }}</h5>
                            @if ($items_by_date->has($current_date->format('Y-m-d')))
                            <ul class="list-disc list-inside">
                                @foreach ($items_by_date[$current_date->format('Y-m-d')] as $item)
                                <li>{{ $item->type }}</li>
                                @endforeach
                            </ul>
                            @else
                            <p>No items for this date</p>
                            @endif
                        </div>
                    </div>
                    @php
                    $current_date->addDay();
                    $counter++;
                    @endphp
                    @endwhile
                </div>
                <a href="{{ route('itineraries.index') }}"><button class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">My itineraries</button></a>
                <a href="{{ route('itineraries.edit', $itinerary->id) }}"><button class="btn btn-primary bg-blue-500 text-white py-2 px-4 ml-5 rounded">Edit itinerary</button></a>
            </div>
        </div>
    </div>
    @endsection