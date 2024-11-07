<div class='update-availability'>
    <x-jet-confirmation-modal wire:model="confirmChange">
        <x-slot name="title">
            Change Availability
        </x-slot>

        <x-slot name="content">
            Are you sure?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('confirmChange', false)" wire:loading.attr="disabled"
                onclick="location.reload()">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2"
                wire:click="changeAvailability({{ $instance }}, {{ $instance->is_available }})"
                wire:loading.attr="disabled">
                Change
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <input wire:click="$set('confirmChange', true)" type="checkbox" {{ $instance->is_available ? 'checked' : '' }}>
</div>
