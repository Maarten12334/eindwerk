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
                    @if($itinerary)
                    <h4 class="mb-4 text-2xl font-bold text-primaryGreen">{{ $itinerary->name }}</h4>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-softWhite">
                        @foreach($hotels as $hotel)
                        <div class="h-full bg-primaryGreen dark:bg-gray-700 rounded-lg shadow-md flex flex-col relative">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-secondaryGreen dark:text-gray-100">{{ $hotel->displayName->text }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $hotel->formattedAddress }}</p>
                            </div>

                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('images/hotelImage.jpg') }}" alt="description of myimage" class="h-full w-full object-cover">
                            </div>

                            <div class="p-4 flex justify-between items-center">
                                <a href="{{ $hotel->websiteUri }}" target="_blank" class="btn bg-blue-500 text-white px-4 py-2 rounded">Visit Website</a>
                                <form action="{{ route('itinerary.addHotel', $itinerary->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $hotel->displayName->text }}">
                                    <input type="hidden" name="arrival" value="{{ $checkInDate }}">
                                    <input type="hidden" name="departure" value="{{ $checkOutDate }}">
                                    <button type="submit" class="btn bg-green-500 text-white px-4 py-2 rounded">Add to Itinerary</button>
                                </form>
                            </div>

                            <div class="absolute top-0 right-0 p-4">
                                <p class="text-xl font-bold text-softWhite dark:text-gray-100">{{ $hotel->rating }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>