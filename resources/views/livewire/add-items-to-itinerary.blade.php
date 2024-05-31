<div>
    @if($buttonClicked)
    <div class="flex items-center">
        <input type="text" class="form-input mt-1 block w-full text-black" placeholder="Enter item..." wire:model="newItem" />
        <button class="btn btn-primary bg-blue-500 text-white py-2 px-4 mt-4 ml-2 rounded" wire:click="saveItem">Save</button>
    </div>
    @else
    <button class="btn btn-primary bg-blue-500 text-white py-2 px-4 mt-4 rounded" wire:click="addItem">{{$message}}</button>
    @endif
</div>