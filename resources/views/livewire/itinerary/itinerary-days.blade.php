<div x-data="{ openForm: null }">
    <div class="flex flex-wrap -mx-4">
        @php
        $current_date = $start_date->copy();
        @endphp
        @while ($current_date->lte($end_date))
        @php
        $dateFormatted = $current_date->format('Y-m-d');
        @endphp
        <div class="w-full md:w-1/2 px-4 mb-6">
            <div class="p-6 bg-primaryGreen dark:bg-gray-700 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-lg font-semibold">{{ $current_date->format('d-m') }}</h5>
                    @foreach ($hotels as $hotel)
                    @if ($current_date->between(Carbon\Carbon::parse($hotel->arrival), Carbon\Carbon::parse($hotel->departure)))
                    <span class="bg-oliveGreen text-secondaryGreen rounded px-2 py-1">{{ $hotel->name }}</span>
                    @endif
                    @endforeach
                </div>
                @php
                $items = collect($items_by_date[$dateFormatted] ?? []);
                $items = $items->sortBy('time');
                @endphp
                <div class="space-y-4">
                    @foreach ($items as $item)
                    <div class="p-2 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-100 flex justify-between items-center">
                        @php
                        $time = \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i');
                        @endphp
                        <span>{{ $item['type'] }}: {{ $time }}</span>
                        <button wire:click="deleteItem({{ $item['id'] }})" class="ml-4 inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-700 disabled:opacity-25 transition">Delete</button>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <button @click="openForm = openForm === '{{ $dateFormatted }}' ? null : '{{ $dateFormatted }}'" x-show="openForm !== '{{ $dateFormatted }}'" class="inline-flex items-center px-4 py-2 bg-oliveGreen border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-700 disabled:opacity-25 transition">
                        Add Item
                    </button>
                    <form wire:submit.prevent="addItem('{{ $dateFormatted }}')" x-show="openForm === '{{ $dateFormatted }}'" class="space-y-4 mt-4">
                        <div class="flex space-x-2">
                            <div class="mb-2 w-full">
                                <label for="type-{{ $dateFormatted }}" class="block text-sm font-medium text-secondaryGreen">Item Type</label>
                                <input type="text" id="type-{{ $dateFormatted }}" wire:model="type.{{ $dateFormatted }}" class="mt-1 block w-full rounded-md text-black border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @error('type.' . $dateFormatted) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2 w-full">
                                <label for="time-{{ $dateFormatted }}" class="block text-sm font-medium text-secondaryGreen">Time</label>
                                <input type="time" id="time-{{ $dateFormatted }}" wire:model="time.{{ $dateFormatted }}" class="mt-1 block w-full rounded-md text-black border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @error('time.' . $dateFormatted) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-oliveGreen border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-700 disabled:opacity-25 transition">
                                Add Item
                            </button>
                            <button type="button" @click="openForm = null" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-700 disabled:opacity-25 transition">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @php
        $current_date->addDay();
        @endphp
        @endwhile
    </div>
</div>