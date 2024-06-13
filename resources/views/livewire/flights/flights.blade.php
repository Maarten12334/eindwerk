<div>
    @if ($flightSchedule)
    @php
    $itinerary = $flightSchedule['itineraries'];
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($itinerary[0]['segments'] as $segment)
        @php
        $airlineName = array_key_exists($segment['carrierCode'], $airlineNames)
        ? $airlineNames[$segment['carrierCode']]
        : 'Unknown Airline';
        $departureDateTime = new DateTime($segment['departure']['at']);
        $arrivalDateTime = new DateTime($segment['arrival']['at']);
        $departureDate = $departureDateTime->format('d-m-Y');
        $departureTime = $departureDateTime->format('H:i');
        $arrivalDate = $arrivalDateTime->format('d-m-Y');
        $arrivalTime = $arrivalDateTime->format('H:i');
        $airlineNameLengthClass = strlen($airlineName) > 15 ? 'text-base' : 'text-lg';
        @endphp
        <div class="flight-segment mb-4 p-6 bg-primaryGreen rounded-lg shadow-lg border border-gray-200 text-secondaryGreen">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="{{ $airlineNameLengthClass }} font-semibold">{{ $airlineName }}</p>
                    <p class="text-sm text-softWhite">{{ $segment['departure']['iataCode'] }} → {{ $segment['arrival']['iataCode'] }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-softWhite">{{ $departureDate }} - {{ $arrivalDate }}</p>
                    <p class="text-sm text-softWhite">{{ $departureTime }} - {{ $arrivalTime }}</p>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium">Departure</p>
                    <p class="text-sm text-softWhite">{{ $segment['departure']['iataCode'] }}</p>
                    <p class="text-sm text-softWhite">{{ $departureDate }} at {{ $departureTime }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium">Arrival</p>
                    <p class="text-sm text-softWhite">{{ $segment['arrival']['iataCode'] }}</p>
                    <p class="text-sm text-softWhite">{{ $arrivalDate }} at {{ $arrivalTime }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-6">
        <button class="bg-primaryGreen text-secondaryGreen px-4 py-2 rounded-lg">
            <p class="text-xl font-semibold">Total Price: <span class="font-normal">{{ $flightSchedule['price']['total'] }}</span></p>
        </button>
    </div>
    @else
    <p>No flight schedule available.</p>
    @endif
</div>