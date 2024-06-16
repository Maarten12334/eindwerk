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
            <div class="grid grid-cols-1 {{ $returnDate ? 'md:grid-cols-2 gap-6' : 'justify-center' }}">
                <div class="{{ $returnDate ? 'md:pr-3' : 'md:mx-auto' }}">
                    <h2 class="text-xl font-bold mb-4 sticky top-0 bg-softWhite bg-opacity-50 dark:bg-gray-800 z-10 p-2">
                        {{ $returnDate ? 'Heenvluchten' : 'Vluchten' }}
                    </h2>
                    @livewire('flights.show-flights', [
                    'origin' => $origin,
                    'destination' => $destination,
                    'departureDate' => $departureDate,
                    'returnDate' => $returnDate,
                    'nonStop' => $nonStop
                    ])
                </div>
                @if ($returnDate)
                <div class="md:pl-3">
                    <h2 class="text-xl font-bold mb-4 sticky top-0 bg-softWhite bg-opacity-50 dark:bg-gray-800 z-10 p-2">Terugvluchten</h2>
                    @livewire('flights.show-flights', [
                    'origin' => $destination,
                    'destination' => $origin,
                    'departureDate' => $returnDate,
                    'returnDate' => $departureDate,
                    'nonStop' => $nonStop
                    ])
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</x-app-layout>