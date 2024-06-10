<div>
    @if ($itemsCount < 5)
        <li
            class="p-2 bg-secondaryGreen dark:bg-gray-600 rounded border border-gray-200 dark:border-gray-500 text-primaryGreen dark:text-gray-300 flex justify-between items-center">
            <span>{{ $item->type }} {{ $item->time }}</span>
            <div class="ml-4 flex items-center space-x-2">
                <button wire:click="editItem({{ $item->id }})" class="text-primaryGreen hover:text-softWhite">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M17.414 2.586a2 2 0 00-2.828 0L2 15.172V18h2.828L17.414 5.414a2 2 0 000-2.828zM6 16H4v-2l10.586-10.586 2 2L6 16z" />
                    </svg>
                </button>
                <button wire:click="deleteItem({{ $item->id }})" class="text-primaryGreen hover:text-softWhite">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v12a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 5a.5.5 0 01.5-.5h5a.5.5 0 01.5.5v9a.5.5 0 01-.5.5h-5a.5.5 0 01-.5-.5V7z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </li>
    @else
        <div
            class="p-2 bg-secondaryGreen dark:bg-gray-600 rounded border border-gray-200 dark:border-gray-500 text-gray-700 dark:text-gray-300 flex justify-between items-center">
            <li>
                {{ $item->type }} {{ $item->time }}
            </li>
            <div class="ml-4 flex items-center space-x-2">
                <button wire:click="editItem({{ $item->id }})" class="text-primaryGreen hover:text-softWhite">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M17.414 2.586a2 2 0 00-2.828 0L2 15.172V18h2.828L17.414 5.414a2 2 0 000-2.828zM6 16H4v-2l10.586-10.586 2 2L6 16z" />
                    </svg>
                </button>
                <button wire:click="deleteItem({{ $item->id }})" class="text-primaryGreen hover:text-softWhite">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v12a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 5a.5.5 0 01.5-.5h5a.5.5 0 01.5.5v9a.5.5 0 01-.5.5h-5a.5.5 0 01-.5-.5V7z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>
