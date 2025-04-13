<div>
    @if(!$updated)
        <x-card title="{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }} Default Score">
            {{ $this->form }}
            <x-secondary-button class="mt-3" wire:click="submit">Submit Default score</x-secondary-button>
        </x-card>
    @else
        <x-card title="Default score">
            <p class="text-green-500">Default score updated successfully</p>
            <a class="mt-3" wire:navigate href="{{ route('admin.fixtures') }}" class="mt-5 p-3 border-gray-400 rounded-md">Back to fixtures</a>
        </x-card>
    @endif
</div>
