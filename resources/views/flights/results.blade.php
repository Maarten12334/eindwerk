<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Vluchten') }}
                </h2>
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative bg-cover bg-center" style="background-image: url('{{ asset('images/airplane.jpg') }}')">

        <div class="p-6 text-gray-900 dark:text-gray-100">
            @if (isset($error))
            <div class="bg-red-500 text-black p-4 rounded-lg">
                <p>Unable to fetch flights</p>
            </div>
            @else
            @if ($returnFlightsData)
            <!-- Check if a return flight is given -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:pr-3">
                    <h2 class="text-xl font-bold mb-4 sticky top-0 bg-softWhite bg-opacity-50 dark:bg-gray-800 z-10 p-2">Departure Flights</h2>
                    @livewire('show-flights', ['departureFlightsData' => $departureFlightsData, 'airlineNames' => $departureAirlineNames, 'nonStop' => $nonStop])
                </div>
                <div class="md:pl-3">
                    <h2 class="text-xl font-bold mb-4 sticky top-0 bg-softWhite bg-opacity-50 dark:bg-gray-800 z-10 p-2">Return Flights</h2>
                    @livewire('show-flights', ['departureFlightsData' => $returnFlightsData, 'airlineNames' => $returnAirlineNames, 'nonStop' => $nonStop])
                </div>
            </div>
            @else
            <div class="grid grid-cols-1 justify-center">
                <div class="md:mx-auto">
                    <h2 class="text-xl font-bold mb-4 sticky top-0 bg-softWhite bg-opacity-50 dark:bg-gray-800 z-10 p-2">Departure Flights</h2>
                    @livewire('show-flights', ['departureFlightsData' => $departureFlightsData, 'airlineNames' => $departureAirlineNames, 'nonStop' => $nonStop])
                </div>
            </div>
            @endif
            @endif
        </div>


    </div>
</x-app-layout>