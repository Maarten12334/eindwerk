<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primaryGreen leading-tight">
            Zoek hotels
        </h2>
    </x-slot>

    <div class="py-16 relative bg-cover bg-center" style="background-image: url('{{ asset('images/hotel.jpg') }}')">
        <div class="container mx-auto p-4 relative bg-white bg-opacity-90 rounded shadow-lg">
            <form action="{{ route('hotels.results', $itinerary) }}" method="GET" id="hotelSearchForm">
                <p>Om mijn google places credits te sparen heb ik een dummyjson gebruikt met hetzelfde formaat als de API, dit is hetzelfde voor de afbeeldingen</p>

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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkInDate = document.getElementById('checkInDate');
            const checkOutDate = document.getElementById('checkOutDate');

            function validateDates() {
                console.log("Check-in Date:", checkInDate.value);
                console.log("Check-out Date:", checkOutDate.value);

                if (checkInDate.value && checkOutDate.value) {
                    const checkIn = new Date(checkInDate.value);
                    const checkOut = new Date(checkOutDate.value);
                    const oneDay = 24 * 60 * 60 * 1000;

                    if (checkOut <= checkIn) {
                        alert("Check-out date must be at least one day after the check-in date.");
                        checkOutDate.value = new Date(checkIn.getTime() + oneDay).toISOString().split('T')[0];
                    }
                }
            }

            checkInDate.addEventListener('focus', validateDates);
            checkOutDate.addEventListener('focus', validateDates);
            checkInDate.addEventListener('change', validateDates);
            checkOutDate.addEventListener('change', validateDates);
        });
    </script>
</x-app-layout>