<div>
    @if(isset($hotels))
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
            @if($itinerary->id)
            <form action="{{ route('itinerary.addHotel', $itinerary->id) }}" method="POST">
                @csrf
                <input type="hidden" name="name" value="{{ $hotel->displayName->text }}">
                <input type="hidden" name="arrival" value="{{ $checkInDate }}">
                <input type="hidden" name="departure" value="{{ $checkOutDate }}">
                <button type="submit" class="btn bg-green-500 text-white px-4 py-2 rounded">Add to Itinerary</button>
            </form>
            @endif
        </div>

        <div class="absolute top-0 right-0 p-4">
            <p class="text-xl font-bold text-softWhite dark:text-gray-100">{{ $hotel->rating }}</p>
        </div>
    </div>
    @endforeach
    @else
    <div>Loading</div>
    @endif
</div>