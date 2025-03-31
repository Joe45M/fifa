<div x-data="{hiring: false}">
    <x-card>
        <x-secondary-button @click="hiring=!hiring">Hire manager</x-secondary-button>
    </x-card>

    <x-card x-show="hiring">
        {{ $this->form }}

        <div class="mt-5">
            <x-primary-button wire:click="storeContract">Hire manager</x-primary-button>
        </div>
    </x-card>
</div>
