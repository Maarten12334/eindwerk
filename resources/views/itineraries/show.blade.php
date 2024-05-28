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
                <div class="grid grid-cols-2 gap-4">
                    @while ($current_date->lte($end_date))
                    <div class="mb-6 {{ $counter % 2 == 0 ? 'col-start-1 text-center' : 'col-start-2 text-center' }}">
                        <h5 class="text-lg font-semibold">{{ $current_date->format('Y-m-d') }}</h5>

                        @if ($items_by_date->has($current_date->format('Y-m-d')))
                        <ul class="list-disc list-inside">
                            @foreach ($items_by_date[$current_date->format('Y-m-d')] as $item)
                            <li>{{ $item->description }}</li>
                            @endforeach
                        </ul>
                        @else
                        <p>No items for this date</p>
                        @endif
                    </div>
                    @php
                    $current_date->addDay();
                    $counter++;
                    @endphp
                    @endwhile
                </div>
            </div>
        </div>
    </div>
</div>
@endsection