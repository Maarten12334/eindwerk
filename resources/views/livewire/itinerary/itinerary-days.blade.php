<div>
    <div class="flex flex-wrap -mx-4">
        @php
        $current_date = $start_date->copy();
        @endphp
        @while ($current_date->lte($end_date))
        <div class="w-full md:w-1/2 px-4 mb-6">
            <div class="p-6 bg-primaryGreen dark:bg-gray-700 rounded-lg shadow-md">
                <h5 class="text-lg font-semibold mb-4">{{ $current_date->format('d-m') }}</h5>
                @php
                $items = collect($items_by_date[$current_date->format('Y-m-d')] ?? []);
                $items = $items->sortBy('time');
                @endphp
                <div class="space-y-4">
                    @foreach ($items as $item)
                    @php
                    $time = \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i');
                    @endphp
                    <div class="p-2 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-100">
                        <span>{{ $item['type'] }}: {{ $time }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <form wire:submit.prevent="addItem('{{ $current_date->format('Y-m-d') }}')">
                        <div class="mb-2">
                            <label for="type-{{ $current_date->format('Y-m-d') }}" class="block text-sm font-medium text-gray-700">Item Type</label>
                            <input type="text" id="type-{{ $current_date->format('Y-m-d') }}" wire:model="type.{{ $current_date->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('type.' . $current_date->format('Y-m-d')) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="time-{{ $current_date->format('Y-m-d') }}" class="block text-sm font-medium text-gray-700">Time</label>
                            <input type="time" id="time-{{ $current_date->format('Y-m-d') }}" wire:model="time.{{ $current_date->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('time.' . $current_date->format('Y-m-d')) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-700 disabled:opacity-25 transition">Add Item</button>
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
