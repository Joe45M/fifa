<div x-data="{creating: false}">

    <x-card>
        <x-secondary-button @click="creating=!creating">Create a new Club</x-secondary-button>
    </x-card>


    <x-card x-show="creating" title="Create a Club">
        {{ $this->form }}

        <x-secondary-button class="mt-3" wire:click="storeClub">Create Club</x-secondary-button>
    </x-card>

    @if($clubs->count())

        <x-card title="Clubs">

            @foreach($clubs as $club)

                <div class="flex -mx-5 px-5 justify-between gap-5 listed">
                    <div class="flex gap-5">

                        <img src="{{ $club->getFirstMediaUrl('logo') }}" alt="Logo" class="w-10 h-10 object-cover rounded-full">

                        <span>{{ $club->name }}</span>
                    </div>
                    <x-primary-button class="self-center" wire:navigate href="{{ route('admin.clubs.edit', $club->id) }}">Edit club</x-primary-button>
                </div>

            @endforeach

        </x-card>

    @endif


</div>
