@extends('layouts.app')

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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($hotels as $hotel)
                    <a href="{{ $hotel->websiteUri }}" target="_blank">
                        <div class="h-full bg-white dark:bg-gray-700 rounded-lg shadow-md flex flex-col relative">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $hotel->displayName->text }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $hotel->formattedAddress }}</p>
                            </div>

                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('images/hotelImage.jpg') }}" alt="description of myimage" class="h-full w-full object-cover">
                            </div>

                            <div class="absolute top-0 right-0 p-4">
                                <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $hotel->rating }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection