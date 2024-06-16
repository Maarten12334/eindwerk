<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @if (isset($hotels['error']))
        <div class="col-span-full bg-secondaryGreen rounded-lg shadow-md p-4">
            <p class="text-black">{{ $hotels['error'] }}</p>
        </div>
        @else
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
                <img src="{{ $hotel['photoUrl'] ?? asset('images/noImageFound.jpg') }}" alt="Hotel Image" class="h-full w-full object-cover">
            </div>

            <div class="p-4 flex justify-between items-center">
                @if(isset($hotel['websiteUri']))
                <a href="{{ $hotel['websiteUri'] }}" target="_blank" class="btn bg-blue-500 text-white px-4 py-2 rounded">Website</a>
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

                    <button type="submit" class="btn bg-green-500 text-white px-4 py-2 rounded">Aan reisschema toevoegen</button>

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
        @endif
    </div>
</div>