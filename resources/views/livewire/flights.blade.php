<div class="flight">
    @php
        $itinerary = $flightSchedule['itineraries'];
    @endphp
    <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($itinerary[0]['segments'] as $segment)
                <div class="mb-4 p-4 bg-gray-800 rounded-lg shadow">
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
                    @endphp
                    <p class="text-lg font-bold text-white">Airline: <span class="font-normal">{{ $airlineName }}</span></p>
                    <p class="text-lg font-bold text-white">Departure Airport: <span class="font-normal">{{ $segment['departure']['iataCode'] }}</span></p>
                    <p class="text-lg font-bold text-white">Departure Date: <span class="font-normal">{{ $departureDate }}</span></p>
                    <p class="text-lg font-bold text-white">Departure Time: <span class="font-normal">{{ $departureTime }}</span></p>
                    <p class="text-lg font-bold text-white">Arrival Airport: <span class="font-normal">{{ $segment['arrival']['iataCode'] }}</span></p>
                    <p class="text-lg font-bold text-white">Arrival Date: <span class="font-normal">{{ $arrivalDate }}</span></p>
                    <p class="text-lg font-bold text-white">Arrival Time: <span class="font-normal">{{ $arrivalTime }}</span></p>
                </div>
            @endforeach
        </div>
        <p class="text-2xl font-bold text-white mt-4">Price: <span class="font-normal">{{ $flightSchedule['price']['total'] }}</span></p>
    </div>
</div>

