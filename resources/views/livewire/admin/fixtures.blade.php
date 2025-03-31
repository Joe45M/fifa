<div  x-data="{creating: false}">

    <x-card>
        <x-secondary-button @click="creating=!creating">Create new fixtures</x-secondary-button>
    </x-card>

    <x-card x-show="creating" title="Create fixtures">
        {{ $this->form }}
        <x-secondary-button class="mt-3" wire:click="generateFixtures">Create fixtures</x-secondary-button>
    </x-card>

    <x-card title="Fixtures">
        @foreach($fixtures as $fixture)

            <div class="flex justify-between listed -mx-5 px-5">
                <div>
                    <p>{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }}</p>
                    <p class="text-sm text-gray-500">{{ $fixture->kickoff_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <a wire:navigate href="{{ route('admin.fixtures.edit', $fixture->id) }}">Edit</a>
                </div>
            </div>
        @endforeach
    </x-card>

</div>
