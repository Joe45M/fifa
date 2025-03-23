<div>

    <x-card title="Manage {{ $league->name }}">
        {{ $this->form }}
        <x-secondary-button class="mt-3" wire:click="storeLeague">Update {{ $league->name }}</x-secondary-button>
    </x-card>
</div>
