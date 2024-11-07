<div>
    <!-- Toggle availability status -->
    <div>
        <label class="flex items-center">
            <input type="checkbox" wire:model="isAvailable" wire:click="changeAvailability"
                class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out">
            <span class="ml-2 text-gray-700">{{ $isAvailable ? 'Available' : 'Borrowed' }}</span>
        </label>
    </div>

    <!-- Confirmation modal for changing availability -->
    <x-jet-confirmation-modal wire:model="confirmChange">
        <x-slot name="title">
            Change Availability
        </x-slot>

        <x-slot name="content">
            Are you sure you want to change the availability status?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('confirmChange', false)" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="changeAvailability" wire:loading.attr="disabled">
                Confirm
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
