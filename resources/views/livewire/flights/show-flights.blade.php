<div>
    <h2 class="text-xl font-bold mb-4 sticky top-0 bg-white dark:bg-gray-800 z-10 p-2">Departure
        Flights</h2>
    <div class="h-128 overflow-y-auto">

        @foreach ($departureFlightsData as $flightSchedule)
            @php
                $isNonStop = count($flightSchedule['itineraries'][0]['segments']) === 1;
            @endphp
            @if (!$nonStop || ($nonStop && $isNonStop))
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md mb-6">
                    @livewire('flights', ['flightSchedule' => $flightSchedule, 'airlineNames' => $airlineNames, 'nonStop' => $nonStop])
                </div>
            @endif
        @endforeach
    </div>
</div>
