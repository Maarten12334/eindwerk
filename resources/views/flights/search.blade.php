<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Zoek een vlucht') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-16 relative bg-cover bg-center" style="background-image: url('{{ asset('images/airport.jpg') }}')">
        <div class="container mx-auto p-4 relative bg-white bg-opacity-90 rounded shadow-lg" x-data="dateValidation()">
            <form action="{{ route('flights.results') }}" method="GET" x-on:submit="return validateDates()">
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
                            <label for="departureDate" class="block mb-2 dark:text-white">Heenvlucht</label>
                            <input type="date" name="departureDate" id="departureDate" class="form-control w-auto p-2 border border-gray-300 rounded" required x-on:change="validateDates" x-on:focus="validateDates" x-init="initializeDate($el)">
                        </div>
                        <div class="flex-shrink-0">
                            <label for="returnDate" class="block mb-2 dark:text-white">Terugvlucht (optioneel)</label>
                            <input type="date" name="returnDate" id="returnDate" class="form-control w-auto p-2 border border-gray-300 rounded" x-on:change="validateDates" x-on:focus="validateDates" x-init="initializeDate($el)">
                        </div>
                    </div>
                    <div class="flex items-center ml-4">
                        <input type="checkbox" name="nonStop" id="nonStop" value="1" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        <label for="nonStop" class="ml-2 dark:text-white">Enkel rechtstreekse vluchten</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary bg-primaryGreen text-secondaryGreen py-2 px-4 rounded">Zoek</button>
            </form>
        </div>
    </div>

    <script src="{{asset('js/searchFlightDateValidation.js')}}"></script>

</x-app-layout>