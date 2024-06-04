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
                    <div class="md:pr-3">
                        <h2 class="text-xl font-bold mb-4 sticky top-0 bg-white dark:bg-gray-800 z-10 p-2">Hotels</h2>
                        <div class="h-128 overflow-y-auto"> <!-- Adjusted height -->
                            @foreach($hotels as $hotel)
                            <a href="{{ $hotel->websiteUri }}">
                                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md mb-6">

                                    <p>{{ $hotel->displayName->text }}</p>
                                    <p>{{ $hotel->formattedAddress }}</p>
                                    <p>rating: {{ $hotel->rating }} out of {{ $hotel->userRatingCount }} ratings</p>

                                    <img src="{{ $hotel->photoUrl }}" alt="">
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




@endsection