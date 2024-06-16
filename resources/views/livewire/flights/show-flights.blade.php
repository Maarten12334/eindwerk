<div>
    <div class="h-128 overflow-y-auto">
        @if ($departureFlightsData)
        @foreach ($departureFlightsData as $flightSchedule)
        @php
        $isNonStop = count($flightSchedule['itineraries'][0]['segments']) === 1;
        @endphp
        @if (!$nonStop || ($nonStop && $isNonStop))
        <div class="p-6 bg-softWhite dark:bg-gray-700 bg-opacity-50 rounded-lg shadow-md mb-6">
            @livewire('flights.flights', ['flightSchedule' => $flightSchedule, 'airlineNames' => $airlineNames, 'nonStop' => $nonStop])
        </div>
        @endif
        @endforeach
        @else
        <p>Geen vluchten gevonden.</p>
        @endif
    </div>
</div>