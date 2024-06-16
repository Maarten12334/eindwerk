<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Reisschema') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4 text-xl">Pas reisschema aan</h1>
                    <form action="{{ route('itineraries.update', $itinerary->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-6">
                            <label for="itineraryName" class="block mb-2 dark:text-white">Naam schema</label>
                            <input type="text" name="name" id="itineraryName" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" value="{{ $itinerary->name }}" required>
                        </div>
                        <div class="form-group mb-6">
                            <label for="departureDate" class="block mb-2 dark:text-white">Vertrekdatum</label>
                            <input type="date" name="departure" id="departureDate" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" value="{{ $itinerary->departure }}" required>
                        </div>
                        <div class="form-group mb-6">
                            <label for="returnDate" class="block mb-2 dark:text-white">Retourdatum</label>
                            <input type="date" name="return" id="returnDate" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" value="{{ $itinerary->return }}" required>
                        </div>
                        <div class="form-group mb-6">
                            <label for="flightId" class="block mb-2 dark:text-white">Vlucht ID (optioneel)</label>
                            <input type="number" name="flight_id" id="flightId" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" value="{{ $itinerary->flight_id }}">
                        </div>
                        <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Opslaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>