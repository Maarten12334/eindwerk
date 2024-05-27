@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Search Hotels by City') }}
</h2>
@endsection

@section('content')
<div class="container mx-auto p-4 px-8"> <!-- Added px-8 for side margins -->
    @if(isset($hotels))
    <h2 class="text-xl font-bold mb-4 dark:text-white">Hotel Results</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($hotels as $hotel)
        <div class="hotel mb-4 p-4 border border-gray-300 rounded dark:text-white">
            <h3 class="font-bold">{{ $hotel['name'] }}</h3>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $hotels->links() }}
    </div>
    @endif
</div>
@endsection