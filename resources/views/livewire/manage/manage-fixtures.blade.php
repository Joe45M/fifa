@php use App\Enum\FixtureStatus; @endphp

<div wire:poll>
    <x-card title="Fixtures">
        @foreach($fixtures as $fixture)
            <div class="flex flex-wrap justify-between items-center listed p-2 border-b border-gray-200">
                <div>
                    <p class="font-bold text-lg">{{ $fixture->kickoff_at->format('d/m/y') }}</p>
                    <p>{{ $fixture->kickoff_at->format('H:i') }}</p>
                </div>
                <div>
                    <p class="text-lg font-semibold mb-2">{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }}</p>
                </div>

                @if($fixture->status == FixtureStatus::Pending)
                    <div class="mt-3 lg:mt-0">
                        <x-secondary-button disabled>Pending approval</x-secondary-button>
                        <div class="text-xs opacity-30 block mt-1 text-right">Pending staff review</div>
                    </div>
                @endif
                @if(!$fixture->hasPropped())
                    <div class="mt-3 lg:mt-0">
                        <x-secondary-button wire:click="submit({{ $fixture->id }})">Submit stats</x-secondary-button>
                    </div>
                @endif
                @if($fixture->hasPropped() && $fixture->status !== FixtureStatus::Pending)
                    <div class="mt-3 lg:mt-0 flex flex-col items-end">
                        <x-secondary-button disabled="">Submitted
                        </x-secondary-button>
                        <div class="text-xs opacity-30 block mt-1"> Waiting for other team</div>

                    </div>
                @endif
            </div>
        @endforeach
    </x-card>
</div>
