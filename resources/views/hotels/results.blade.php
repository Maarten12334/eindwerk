<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primaryGreen leading-tight">
            Hotels
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    @if($itinerary->id)
                    <h4 class="mb-4 text-2xl font-bold text-primaryGreen">test{{ $itinerary->name }}</h4>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-softWhite">
                        @livewire('hotels.hotel-results', ['itinerary' => $itinerary])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>