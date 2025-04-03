@php use Illuminate\Support\Str; @endphp
<div class="overflow-x-hidden">


    <div class="rounded-t-md bg-white -mx-5 p-5 pb-32">

        @if($step === 'stats')

            <div class="flex flex-col gap-1 mb-5 pb-5 border-b border-b-gray-200">
                <h2 class="text-2xl font-bold">{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }}</h2>
                <p class="text-gray-500"><span class="font-bold">Step 2</span>. Stats for {{ $players->first()->name }}</p>
            </div>


            <div class="flex flex-col gap-4">
                @foreach($stats as $stat)
                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label>{{ Str::title($stat) }}</x-input-label>
                            <x-text-input>

                            </x-text-input>
                        </div>

                        <hr class="mt-4 border-t-gray-300">
                    </div>
                @endforeach
            </div>


        @endif

        @if($step === 'players')
            <div class="flex flex-col gap-1 mb-5 pb-5 border-b border-b-gray-200">
                <h2 class="text-2xl font-bold">{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }}</h2>
                <p class="text-gray-500"><span class="font-bold">Step 1</span>. Select who played</p>
            </div>

            <div class="flex flex-col gap-4">
                @foreach($players as $player)

                    <label class="styled-checkbox block w-full text-center border-gray-300 border p-5 rounded-xl" for="player-{{ $player->id }}-player">
                        <input type="checkbox" class="w-0 h-0 overflow-hidden opacity-0" wire:model.live="fieldedPlayers" value="{{ $player->id }}" id="player-{{ $player->id }}-player" class="mr-2">

                        {{ $player->name }}
                    </label>

                @endforeach
            </div>
        @endif
    </div>


    <div class="fixed left-0 z-50 justify-between items-center bottom-0 w-full bg-white p-3 border-t border-t-gray-300 shadow-xl flex">
        @if($step === 'players')

            @if(count($fieldedPlayers) > 2)

                {{ count($fieldedPlayers) }} players selected
                <x-primary-button wire:click="nextStep('stats')">Next</x-primary-button>
            @else
                <div class="flex-grow text-gray-400">
                    <i class="fa-regular fa-triangle-exclamation text-red-500"></i>
                    {{ 3 - count($fieldedPlayers) }} more players to select
                </div>
                <x-secondary-button disabled>Next</x-secondary-button>
            @endif
        @endif

            @if($step === 'stats')
                <div class="w-full flex justify-end">
                    <x-primary-button>Next player</x-primary-button>
                </div>
            @endif
    </div>
</div>
