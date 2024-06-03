<div class="flight">
    @php
        $itinerary = $flightSchedule['itineraries'];
    @endphp
    <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($itinerary[0]['segments'] as $segment)
            <div class="mb-4">
                <p class="text-white">{{ $segment['departure']['iataCode'] }}</p>
                <p class="text-white">{{ $segment['departure']['at'] }}</p>
                <p class="text-white">{{ $segment['arrival']['iataCode'] }}</p>
                <p class="text-white">{{ $segment['arrival']['at'] }}</p>
            </div>
            @endforeach
        </div>
        <p class="text-white mt-4">Price: {{ $flightSchedule['price']['total'] }}</p>
    </div>
</div>
