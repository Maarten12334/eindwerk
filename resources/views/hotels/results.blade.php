<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Hotels') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-16 relative bg-cover bg-center" style="background-image: url('{{ asset('images/hotelBackground.jpg') }}')">
        <div class="container mx-auto p-6 relative bg-softWhite bg-opacity-50 rounded shadow-lg text-secondaryGreen dark:text-gray-100">
            @if($itinerary && $itinerary->id)
            <h4 class="mb-4 text-2xl font-bold text-primaryGreen">{{ $itinerary->name }}</h4>
            @endif
            <h2 class="mb-4 text-2xl font-bold text-primaryGreen">Deze hotels zijn beschikbaar in: {{ $city }}</h2>
            @livewire('Hotels.HotelList', ['city' => $city, 'radius' => $radius, 'itinerary' => $itinerary, 'checkInDate' => $checkInDate, 'checkOutDate' => $checkOutDate])
        </div>
    </div>
</x-app-layout>