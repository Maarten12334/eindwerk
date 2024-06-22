<div x-data="{ openForm: null }" @item-added.window="openForm = null">
    <div class="flex flex-wrap -mx-4">
        @php
        $current_date = $start_date->copy();
        @endphp
        @while ($current_date->lte($end_date))
        @php
        $dateFormatted = $current_date->format('Y-m-d');
        $hotelsCheckOut = $itinerary->hotels->filter(function($hotel) use ($current_date) {
        return $current_date->isSameDay(Carbon\Carbon::parse($hotel->departure));
        });
        $hotelsCheckIn = $itinerary->hotels->filter(function($hotel) use ($current_date) {
        return $current_date->isSameDay(Carbon\Carbon::parse($hotel->arrival));
        });
        $hotelsDuringStay = $itinerary->hotels->filter(function($hotel) use ($current_date) {
        return $current_date->between(Carbon\Carbon::parse($hotel->arrival), Carbon\Carbon::parse($hotel->departure)) &&
        !$current_date->isSameDay(Carbon\Carbon::parse($hotel->arrival)) &&
        !$current_date->isSameDay(Carbon\Carbon::parse($hotel->departure));
        });
        @endphp
        <div class="w-full md:w-1/2 px-4 mb-4">
            <div class="p-6 bg-primaryGreen bg-opacity-70 dark:bg-gray-700 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-2">
                    <h5 class="text-lg font-semibold">{{ $current_date->format('d-m') }}</h5>
                </div>
                {{-- Display hotels with check-out --}}
                @foreach ($hotelsCheckOut as $hotel)
                <div class="flex items-center space-x-2 text-secondaryGreen rounded mb-1">
                    <p class="text-secondaryGreen">Check-out:</p>
                    <div class="bg-oliveGreen rounded flex items-center px-2 py-1">
                        <span>{{ $hotel->name }}</span>
                        @if (!$visit)
                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit hotel wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-secondaryGreen hover:text-green-700 ml-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
                {{-- Display hotels with check-in --}}
                @foreach ($hotelsCheckIn as $hotel)
                <div class="flex items-center space-x-2 text-secondaryGreen rounded mb-1">
                    <p class="text-secondaryGreen">Check-in:</p>
                    <div class="bg-oliveGreen rounded flex items-center px-2 py-1">
                        <span>{{ $hotel->name }}</span>
                        @if (!$visit)
                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit hotel wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-secondaryGreen hover:text-green-700 ml-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
                {{-- Display hotels during stay --}}
                @foreach ($hotelsDuringStay as $hotel)
                <div class="flex items-center space-x-2 mb-1">
                    <div class="bg-oliveGreen text-secondaryGreen rounded flex items-center px-2 py-1">
                        <span>{{ $hotel->name }}</span>
                        @if (!$visit)
                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit hotel wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-secondaryGreen hover:text-green-700 ml-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
                {{-- Display itinerary items --}}
                @php
                $items = collect($items_by_date[$dateFormatted] ?? []);
                $items = $items->sortBy('time');
                @endphp
                <div class="bg-secondaryGreen rounded-lg p-4 mt-2">
                    <div class="space-y-2 day-container" style="height: 300px; overflow-y: auto;">
                        @foreach ($items as $item)
                        <div class="p-2 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-100 flex justify-between items-center">
                            @php
                            $time = \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i');
                            @endphp
                            <span>{{ $item['type'] }}: {{ $time }}</span>
                            @if (!$visit)
                            <button wire:click="deleteItem({{ $item['id'] }})" class="ml-4 text-secondaryGreen hover:text-green-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @if (!$visit)
                <div class="mt-4">
                    <button @click="openForm = openForm === '{{ $dateFormatted }}' ? null : '{{ $dateFormatted }}'" x-show="openForm !== '{{ $dateFormatted }}'" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-700 disabled:opacity-25 transition">
                        Voeg een activiteit toe
                    </button>
                    <form wire:submit.prevent="addItem('{{ $dateFormatted }}')" x-show="openForm === '{{ $dateFormatted }}'" x-ref="form-{{ $dateFormatted }}" @submit="openForm = null; $nextTick(() => { $refs['type-{{ $dateFormatted }}'].value = ''; $refs['time-{{ $dateFormatted }}'].value = ''; })" class="space-y-4 mt-4">
                        <div class="flex space-x-2">
                            <div class="mb-2 w-full">
                                <label for="type-{{ $dateFormatted }}" class="block text-sm font-medium text-secondaryGreen">Activiteit</label>
                                <input type="text" id="type-{{ $dateFormatted }}" wire:model="type.{{ $dateFormatted }}" x-ref="type-{{ $dateFormatted }}" class="mt-1 block w-full rounded-md text-black border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @error('type.' . $dateFormatted) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2 w-full">
                                <label for="time-{{ $dateFormatted }}" class="block text-sm font-medium text-secondaryGreen">Tijd</label>
                                <input type="time" id="time-{{ $dateFormatted }}" wire:model="time.{{ $dateFormatted }}" x-ref="time-{{ $dateFormatted }}" class="mt-1 block w-full rounded-md text-black border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @error('time.' . $dateFormatted) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-oliveGreen border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-700 disabled:opacity-25 transition">
                                Toevoegen
                            </button>
                            <button type="button" @click="openForm = null" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-700 disabled:opacity-25 transition">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @php
        $current_date->addDay();
        @endphp
        @endwhile
    </div>
</div>