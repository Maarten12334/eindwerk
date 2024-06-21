<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Details reis') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-16 relative bg-cover bg-center" style="background-image: url('{{ asset('images/map.jpg') }}')">
        <div class="container mx-auto p-6 relative bg-softWhite bg-opacity-50 rounded shadow-lg text-secondaryGreen dark:text-gray-100">
            <h4 class="mb-4 text-2xl font-bold text-primaryGreen">{{ $itinerary->name }}</h4>

            @livewire('itinerary.itinerary-days', [
            'itinerary' => $itinerary,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'items_by_date' => $items_by_date,
            'visit' => true
            ])


        </div>
    </div>

</x-app-layout>