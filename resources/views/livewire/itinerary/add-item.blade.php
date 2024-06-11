<div class="mt-4">
    <form wire:submit.prevent="addItem" class="flex items-center space-x-2">
        <input type="hidden" wire:model="current_date" value="{{ $current_date }}">
        <div class="mb-2 flex-1">
            <label for="type" class="block text-sm font-medium text-gray-700">Item Type</label>
            <input type="text" id="type" wire:model="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2 flex-1">
            <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
            <input type="time" id="time" wire:model="time" step="300" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-700 disabled:opacity-25 transition">Add Item</button>
    </form>
</div>
