<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primaryGreen">
            {{ __('Search Flights') }}
        </h2>
    </x-slot>

    <div class="py-16 relative bg-cover bg-center" style="background-image: url('{{ asset('images/airport.jpg') }}')">
        <div class="container mx-auto p-4  relative bg-white bg-opacity-90 rounded shadow-lg">
            <form action="{{ route('flights.results') }}" method="GET" onsubmit="return validateDates()">
                <div class="form-group mb-6">
                    <p>Momenteel kunnen enkel steden ingegeven worden in het formaat: Brussel = BRU, Parijs = PAR, Londen = LON, ... </p>
                    <label for="origin" class="block mb-2 dark:text-white">Origin</label>
                    <input type="text" name="origin" id="origin" class="form-control w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="form-group mb-6">
                    <label for="destination" class="block mb-2 dark:text-white">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="form-group mb-6 flex space-x-4 items-center">
                    <div class="flex space-x-4">
                        <div class="flex-shrink-0">
                            <label for="departureDate" class="block mb-2 dark:text-white">Departure Date</label>
                            <input type="date" name="departureDate" id="departureDate" class="form-control w-auto p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="flex-shrink-0">
                            <label for="returnDate" class="block mb-2 dark:text-white">Return Date (optional)</label>
                            <input type="date" name="returnDate" id="returnDate" class="form-control w-auto p-2 border border-gray-300 rounded">
                        </div>
                    </div>
                    <div class="flex items-center ml-4">
                        <input type="checkbox" name="nonStop" id="nonStop" value="1" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        <label for="nonStop" class="ml-2 dark:text-white">Non-stop flights only</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary bg-primaryGreen text-secondaryGreen py-2 px-4 rounded">Search</button>
            </form>
        </div>
    </div>

    <script src="{{asset('js/searchFlightDateValidation.js')}}"></script>
</x-app-layout>