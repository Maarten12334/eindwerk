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
            @if (session('error'))
            <div class="mb-4 text-red-500">
                {{ session('error') }}
            </div>
            @endif

            @if($itinerary && $itinerary->id)
            <h4 class="mb-4 text-2xl font-bold text-primaryGreen">{{ $itinerary->name }}</h4>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($hotels as $hotel)
                <div class="h-full bg-primaryGreen dark:bg-gray-700 rounded-lg shadow-md flex flex-col relative">
                    <div class="p-4">
                        @if(isset($hotel['displayName']['text']))
                        <h3 class="text-lg font-bold text-secondaryGreen dark:text-gray-100">{{ $hotel['displayName']['text'] }}</h3>
                        @endif

                        @if(isset($hotel['formattedAddress']))
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $hotel['formattedAddress'] }}</p>
                        @endif
                    </div>

                    <div class="h-48 overflow-hidden">
                        <img src="{{ $hotel['photoUrl'] ?? asset('images/hotelImage.jpg') }}" alt="Hotel Image" class="h-full w-full object-cover">
                    </div>

                    <div class="p-4 flex justify-between items-center">
                        @if(isset($hotel['websiteUri']))
                        <a href="{{ $hotel['websiteUri'] }}" target="_blank" class="btn bg-blue-500 text-white px-4 py-2 rounded">Visit Website</a>
                        @endif

                        @if($itinerary && $itinerary->id)
                        <form action="{{ route('itinerary.addHotel', $itinerary->id) }}" method="POST">
                            @csrf

                            @if(isset($hotel['displayName']['text']))
                            <input type="hidden" name="name" value="{{ $hotel['displayName']['text'] }}">
                            @endif

                            @if(isset($hotel['formattedAddress']))
                            <input type="hidden" name="address" value="{{ $hotel['formattedAddress'] }}">
                            @endif

                            <input type="hidden" name="arrival" value="{{ $checkInDate }}">
                            <input type="hidden" name="departure" value="{{ $checkOutDate }}">

                            <button type="submit" class="btn bg-green-500 text-white px-4 py-2 rounded">Add to Itinerary</button>

                            @if ($errors->has('address'))
                            <div class="text-red-500 mt-2">
                                {{ $errors->first('address') }}
                            </div>
                            @endif
                        </form>
                        @endif
                    </div>

                    @if(isset($hotel['rating']))
                    <div class="absolute top-0 right-0 p-4">
                        <p class="text-xl font-bold text-softWhite dark:text-gray-100">{{ $hotel['rating'] }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>