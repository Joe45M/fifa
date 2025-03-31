<div>
    <x-card title="Edit fixture">
        {{ $this->form }}
        <x-secondary-button class="mt-3" wire:click="saveFixture">Save changes</x-secondary-button>
    </x-card>
</div>
