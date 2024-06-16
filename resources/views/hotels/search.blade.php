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
        <div class="container mx-auto p-4 relative bg-white bg-opacity-90 rounded shadow-lg mb-8" x-data="dateValidation({{ json_encode($itinerary->departure ?? null) }}, {{ json_encode($itinerary->return ?? null) }})">
            <form action="{{ route('hotels.results', $itinerary) }}" method="GET" id="hotelSearchForm">
                @if($itinerary)
                <input type="hidden" name="itinerary_id" value="{{ $itinerary->id }}">
                @endif

                <div class="form-group mb-6">
                    <label for="city" class="block mb-2 dark:text-white">Stad:</label>
                    <input type="text" id="city" name="city" class="form-control w-full p-2 border border-gray-300 rounded" value="{{ $itinerary->city ?? '' }}" required>
                </div>

                <div class="form-group mb-6">
                    <label for="radius" class="block mb-2 dark:text-white">Maximale afstand van het centrum (meters):</label>
                    <input type="number" id="radius" name="radius" value="5000" class="form-control w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="form-group mb-6 flex space-x-4">
                    <div>
                        <label for="checkInDate" class="block mb-2 dark:text-white">Check-in:</label>
                        <input type="date" id="checkInDate" name="checkInDate" class="form-control w-full p-2 border border-gray-300 rounded" value="{{ $itinerary->start_date ?? '' }}" required x-on:change="validateDates" x-on:focus="validateDates" x-init="initializeDate($el)">
                    </div>

                    <div>
                        <label for="checkOutDate" class="block mb-2 dark:text-white">Check-out:</label>
                        <input type="date" id="checkOutDate" name="checkOutDate" class="form-control w-full p-2 border border-gray-300 rounded" value="{{ $itinerary->end_date ?? '' }}" required x-on:change="validateDates" x-on:focus="validateDates" x-init="initializeDate($el)">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary bg-primaryGreen text-white py-2 px-4 rounded">Zoeken</button>
            </form>
        </div>

        @if($itinerary)
        <!-- Second form container -->
        <div class="container mx-auto p-4 relative bg-white bg-opacity-90 rounded shadow-lg mt-8" x-data="dateValidation({{ json_encode($itinerary->departure ?? null) }}, {{ json_encode($itinerary->return ?? null) }})">
            <!-- Form to add a hotel manually -->
            <form action="{{ route('itinerary.addHotel', $itinerary->id) }}" method="POST">
                @csrf
                <h3 class="text-xl font-semibold text-primaryGreen mb-4">Voeg zelf een hotel toe</h3>

                <input type="hidden" name="itinerary_id" value="{{ $itinerary->id }}">

                <div class="form-group mb-6">
                    <label for="name" class="block mb-2 dark:text-white">Naam hotel:</label>
                    <input type="text" id="name" name="name" class="form-control w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="form-group mb-6 flex space-x-4">
                    <div>
                        <label for="arrival" class="block mb-2 dark:text-white">Check-in:</label>
                        <input type="date" id="arrival" name="arrival" class="form-control w-full p-2 border border-gray-300 rounded" required x-on:change="validateDates" x-on:focus="validateDates" x-init="initializeDate($el)">
                    </div>

                    <div>
                        <label for="departure" class="block mb-2 dark:text-white">Check-out:</label>
                        <input type="date" id="departure" name="departure" class="form-control w-full p-2 border border-gray-300 rounded" required x-on:change="validateDates" x-on:focus="validateDates" x-init="initializeDate($el)">
                    </div>
                </div>

                <div class="form-group mb-6">
                    <label for="address" class="block mb-2 dark:text-white">Adres:</label>
                    <input type="text" id="address" name="address" class="form-control w-full p-2 border border-gray-300 rounded" required>
                </div>

                <button type="submit" class="btn btn-primary bg-primaryGreen text-white py-2 px-4 rounded">Toevoegen aan reisschema</button>
            </form>
        </div>
        @endif
    </div>

    <script src="{{asset('js/searchHotelDateValidation.js')}}"></script>

</x-app-layout>