<div>
    <x-card title="Edit a Club">
        {{ $this->form }}
        <x-secondary-button class="mt-3" wire:click="editClub">Edit Club</x-secondary-button>
    </x-card>

    <x-card title="All club players">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @if($club->players->count())
                @foreach($club->players as $player)
                    <div>
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-bold">{{ $player->name }}</h2>
                                <span>{{ $player->currentContract->games_remaining }} games remaining</span>
                            </div>
                            <div>
                                <x-secondary-button wire:confirm wire:click="releasePlayer({{ $player->currentContract->id }})">Release</x-secondary-button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No active players</p>
            @endif
        </div>

    </x-card>

</div>
