<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Maak een nieuwe reis') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('itineraries.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-6">
                            <label for="itineraryName" class="block mb-2 dark:text-white">Naam reis</label>
                            <input type="text" name="name" id="itineraryName" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                        </div>
                        <div class="form-group mb-6">
                            <label for="departureDate" class="block mb-2 dark:text-white">Vertrek datum</label>
                            <input type="date" name="departure" id="departureDate" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                        </div>
                        <div class="form-group mb-6">
                            <label for="returnDate" class="block mb-2 dark:text-white">Eind datum</label>
                            <input type="date" name="return" id="returnDate" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                        </div>
                        <div class="form-group mb-6">
                            <label for="flightId" class="block mb-2 dark:text-white">Vlucht Id (optioneel)</label>
                            <input type="text" name="flight_id" id="flightId" class="form-control w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded">
                        </div>
                        <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Opslaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>