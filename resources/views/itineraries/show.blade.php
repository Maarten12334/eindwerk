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
                    @php
                        $current_date = $start_date->copy();
                        $counter = 0;
                    @endphp
                    <div class="flex flex-wrap -mx-4">
                        @while ($current_date->lte($end_date))
                            <div class="w-full md:w-1/2 px-4 mb-6 {{ $counter % 2 == 0 ? 'md:self-start' : 'md:self-end' }}">
                                @php
                                    $items = $items_by_date[$current_date->format('Y-m-d')] ?? collect();
                                    $items = $items->sortBy('time');
                                    $itemsCount = $items->count();
                                @endphp
                                <div
                                    class="p-6 bg-primaryGreen dark:bg-gray-700 rounded-lg shadow-md {{ $itemsCount > 10 ? 'max-h-96 overflow-y-scroll' : '' }}">
                                    <h5 class="text-lg font-semibold mb-4">{{ $current_date->format('d-m') }}</h5>
                                    @if ($itemsCount > 0)
                                        @if ($itemsCount > 5)
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                @foreach ($items as $item)
                                                    @livewire('item-actions', ['item' => $item, 'itemsCount' => $itemsCount])
                                                @endforeach
                                            </div>
                                        @else
                                            <ul class="space-y-2">
                                                @foreach ($items as $item)
                                                    @livewire('item-actions', ['item' => $item, 'itemsCount' => $itemsCount])
                                                @endforeach
                                            </ul>
                                        @endif
                                    @else
                                        <p class="text-secondaryGreen dark:text-gray-400">No items for this date</p>
                                    @endif
                                    @livewire('AddItemsToItinerary', ['current_date' => $current_date, 'itinerary_id' => $itinerary->id])
                                </div>
                            </div>
                            @php
                                $current_date->addDay();
                                $counter++;
                            @endphp
                        @endwhile
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('itineraries.index') }}"
                            class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">My
                            itineraries</a>
                        <a href="{{ route('itineraries.edit', $itinerary->id) }}"
                            class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 ml-4 rounded">Edit
                            itinerary</a>
                        @livewire('SearchFlightButton', ['itinerary' => $itinerary])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
