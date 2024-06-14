<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Zoek een hotel') }}
                    @if ($itinerary)
                    voor je reis naar: {{ $itinerary->name }}
                    @endif
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-16 relative bg-cover bg-center" style="background-image: url('{{ asset('images/hotel.jpg') }}')">
        <!-- First form container -->
        <div class="container mx-auto p-4 relative bg-white bg-opacity-90 rounded shadow-lg mb-8">
            <form action="{{ route('hotels.results', $itinerary) }}" method="GET" id="hotelSearchForm">
                @if($itinerary)
                <input type="hidden" name="itinerary_id" value="{{ $itinerary->id }}">
                @endif

                <div class="form-group mb-6">
                    <label for="city" class="block mb-2 dark:text-white">City:</label>
                    <input type="text" id="city" name="city" class="form-control w-full p-2 border border-gray-300 rounded" value="{{ $itinerary->city ?? '' }}" required>
                </div>

                <div class="form-group mb-6">
                    <label for="radius" class="block mb-2 dark:text-white">Radius (meters):</label>
                    <input type="number" id="radius" name="radius" value="5000" class="form-control w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="form-group mb-6 flex space-x-4">
                    <div>
                        <label for="checkInDate" class="block mb-2 dark:text-white">Check-in Date:</label>
                        <input type="date" id="checkInDate" name="checkInDate" class="form-control w-full p-2 border border-gray-300 rounded" value="{{ $itinerary->start_date ?? '' }}" required>
                    </div>

                    <div>
                        <label for="checkOutDate" class="block mb-2 dark:text-white">Check-out Date:</label>
                        <input type="date" id="checkOutDate" name="checkOutDate" class="form-control w-full p-2 border border-gray-300 rounded" value="{{ $itinerary->end_date ?? '' }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary bg-primaryGreen text-white py-2 px-4 rounded">Search</button>
            </form>
        </div>

        @if($itinerary)
        <!-- Second form container -->
        <div class="container mx-auto p-4 relative bg-white bg-opacity-90 rounded shadow-lg mt-8">
            <!-- Form to add a hotel manually -->
            <form action="{{ route('itinerary.addHotel', $itinerary->id) }}" method="POST">
                @csrf
                <h3 class="text-xl font-semibold text-primaryGreen mb-4">Add Hotel Manually</h3>

                <input type="hidden" name="itinerary_id" value="{{ $itinerary->id }}">

                <div class="form-group mb-6">
                    <label for="name" class="block mb-2 dark:text-white">Hotel Name:</label>
                    <input type="text" id="name" name="name" class="form-control w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="form-group mb-6 flex space-x-4">
                    <div>
                        <label for="arrival" class="block mb-2 dark:text-white">Check-in Date:</label>
                        <input type="date" id="arrival" name="arrival" class="form-control w-full p-2 border border-gray-300 rounded" required>
                    </div>

                    <div>
                        <label for="departure" class="block mb-2 dark:text-white">Check-out Date:</label>
                        <input type="date" id="departure" name="departure" class="form-control w-full p-2 border border-gray-300 rounded" required>
                    </div>
                </div>

                <div class="form-group mb-6">
                    <label for="address" class="block mb-2 dark:text-white">Address:</label>
                    <input type="text" id="address" name="address" class="form-control w-full p-2 border border-gray-300 rounded" required>
                </div>

                <button type="submit" class="btn btn-primary bg-primaryGreen text-white py-2 px-4 rounded">Add Hotel</button>
            </form>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkInDate = document.getElementById('checkInDate');
            const checkOutDate = document.getElementById('checkOutDate');
            const manualCheckInDate = document.getElementById('arrival');
            const manualCheckOutDate = document.getElementById('departure');

            @if($itinerary)
            const itineraryDeparture = new Date("{{ $itinerary->departure }}");
            const itineraryReturn = new Date("{{ $itinerary->return }}");

            // Setting the min and max attributes for the date inputs
            checkInDate.min = itineraryDeparture.toISOString().split('T')[0];
            checkInDate.max = itineraryReturn.toISOString().split('T')[0];
            checkOutDate.min = itineraryDeparture.toISOString().split('T')[0];
            checkOutDate.max = itineraryReturn.toISOString().split('T')[0];

            manualCheckInDate.min = itineraryDeparture.toISOString().split('T')[0];
            manualCheckInDate.max = itineraryReturn.toISOString().split('T')[0];
            manualCheckOutDate.min = itineraryDeparture.toISOString().split('T')[0];
            manualCheckOutDate.max = itineraryReturn.toISOString().split('T')[0];

            function validateDates() {
                if (checkInDate.value && checkOutDate.value) {
                    const checkIn = new Date(checkInDate.value);
                    const checkOut = new Date(checkOutDate.value);
                    const oneDay = 24 * 60 * 60 * 1000;

                    if (checkOut <= checkIn) {
                        alert("Check-out date must be at least one day after the check-in date.");
                        checkOutDate.value = new Date(checkIn.getTime() + oneDay).toISOString().split('T')[0];
                    }
                }

                if (manualCheckInDate.value && manualCheckOutDate.value) {
                    const checkIn = new Date(manualCheckInDate.value);
                    const checkOut = new Date(manualCheckOutDate.value);
                    const oneDay = 24 * 60 * 60 * 1000;

                    if (checkOut <= checkIn) {
                        alert("Check-out date must be at least one day after the check-in date.");
                        manualCheckOutDate.value = new Date(checkIn.getTime() + oneDay).toISOString().split('T')[0];
                    }
                }
            }

            checkInDate.addEventListener('focus', validateDates);
            checkOutDate.addEventListener('focus', validateDates);
            checkInDate.addEventListener('change', validateDates);
            checkOutDate.addEventListener('change', validateDates);

            manualCheckInDate.addEventListener('focus', validateDates);
            manualCheckOutDate.addEventListener('focus', validateDates);
            manualCheckInDate.addEventListener('change', validateDates);
            manualCheckOutDate.addEventListener('change', validateDates);
            @endif
        });
    </script>
</x-app-layout>