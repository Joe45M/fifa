<div x-data="{creating: false}">

    <x-card>
        <x-secondary-button @click="creating=!creating">Create a new league</x-secondary-button>
    </x-card>


    <x-card x-show="creating" title="Create a league">
        {{ $this->form }}

        <x-secondary-button class="mt-3" wire:click="storeLeague">Create league</x-secondary-button>
    </x-card>

    @if($leagues->count())

        <x-card title="Leagues">

            @foreach($leagues as $league)

                <div class="flex -mx-5 px-5 justify-between gap-5 listed">
                    <img src="{{ $league->getFirstMediaUrl('logo') }}" alt="Logo" class="w-10 h-10 object-contain rounded-full">
                    <span>{{ $league->name }}</span>
                    <x-primary-button wire:navigate href="{{ route('admin.leagues.edit', $league->id) }}">Edit league</x-primary-button>
                </div>

            @endforeach

        </x-card>

    @endif


</div>
