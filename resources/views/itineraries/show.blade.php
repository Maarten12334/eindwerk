@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Itinerary Details') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h4 class="mb-4 text-2xl font-bold">{{ $itinerary->name }}</h4>
                @php
                $current_date = $start_date->copy();
                $counter = 0;
                @endphp
                <div class="flex flex-wrap -mx-4">
                    @while ($current_date->lte($end_date))
                    <div class="w-full md:w-1/2 px-4 mb-6 {{ $counter % 2 == 0 ? 'md:self-start' : 'md:self-end' }}">
                        @php
                        $items = $items_by_date[$current_date->format('Y-m-d')] ?? collect();
                        $itemsCount = $items->count();
                        @endphp
                        <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md {{ $itemsCount > 10 ? 'max-h-96 overflow-y-scroll' : '' }}">
                            <h5 class="text-lg font-semibold mb-4">{{ $current_date->format('d-m') }}</h5>
                            @if ($itemsCount > 0)
                            @if ($itemsCount > 5)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($items as $item)
                                <div class="p-2 bg-gray-100 dark:bg-gray-600 rounded border border-gray-200 dark:border-gray-500 text-gray-700 dark:text-gray-300 flex justify-between items-center">
                                    <li>
                                        {{ $item->type }}
                                    </li>
                                    <div class="ml-4 flex items-center space-x-2">
                                        <button wire:click="editItem({{ $item->id }})" class="text-blue-500 hover:text-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L2 15.172V18h2.828L17.414 5.414a2 2 0 000-2.828zM6 16H4v-2l10.586-10.586 2 2L6 16z" />
                                            </svg>
                                        </button>
                                        <button wire:click="deleteItem({{ $item->id }})" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v12a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 5a.5.5 0 01.5-.5h5a.5.5 0 01.5.5v9a.5.5 0 01-.5.5h-5a.5.5 0 01-.5-.5V7z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <ul class="space-y-2">
                                @foreach ($items as $item)
                                <li class="p-2 bg-gray-100 dark:bg-gray-600 rounded border border-gray-200 dark:border-gray-500 text-gray-700 dark:text-gray-300 flex justify-between items-center">
                                    <span>{{ $item->type }}</span>
                                    <div class="ml-4 flex items-center space-x-2">
                                        <button wire:click="editItem({{ $item->id }})" class="text-blue-500 hover:text-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L2 15.172V18h2.828L17.414 5.414a2 2 0 000-2.828zM6 16H4v-2l10.586-10.586 2 2L6 16z" />
                                            </svg>
                                        </button>
                                        <button wire:click="deleteItem({{ $item->id }})" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v12a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 5a.5.5 0 01.5-.5h5a.5.5 0 01.5.5v9a.5.5 0 01-.5.5h-5a.5.5 0 01-.5-.5V7z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            @else
                            <p class="text-gray-600 dark:text-gray-400">No items for this date</p>
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
                    <a href="{{ route('itineraries.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">My itineraries</a>
                    <a href="{{ route('itineraries.edit', $itinerary->id) }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 ml-4 rounded">Edit itinerary</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection