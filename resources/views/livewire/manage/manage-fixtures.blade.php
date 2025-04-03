<div>
    <x-card title="Fixtures">
        @foreach($fixtures as $fixture)
            <div class="flex justify-between items-center listed p-2 border-b border-gray-200">
                <div>
                    <p class="font-bold text-lg">{{ $fixture->kickoff_at->format('d/m/y') }}</p>
                    <p>{{ $fixture->kickoff_at->format('H:i') }}</p>
                </div>
                <div>
                    <p class="text-lg font-semibold mb-2">{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }}</p>
                </div>
                <div>
                    <x-secondary-button wire:click="submit({{ $fixture->id }})">Submit stats</x-secondary-button>
                </div>
            </div>
        @endforeach
    </x-card>
</div>
