<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primaryGreen leading-tight">
            {{ __('Search for hotels') }}
        </h2>
    </x-slot>

    <body>
        <div class="container mx-auto p-4">
            <form action="{{ route('hotels.apiRequest') }}" method="GET" id="hotelSearchForm">
                <p>Om mijn google places credits te sparen heb ik een dummyjson gebruikt met hetzelfde formaat als de API, dit is hetzelfde voor de afbeeldingen</p>
                <div class="form-group mb-6">
                    <label for="city" class="block mb-2 dark:text-white">City:</label>
                    <input type="text" id="city" name="city" class="form-control w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="form-group mb-6">
                    <label for="radius" class="block mb-2 dark:text-white">Radius (meters):</label>
                    <input type="number" id="radius" name="radius" value="5000" class="form-control w-full p-2 border border-gray-300 rounded">
                </div>
                <button type="submit" class="btn btn-primary bg-primaryGreen text-white py-2 px-4 rounded">Search</button>
            </form>
        </div>
    </body>
</x-app-layout>