<div  x-data="{creating: false}">

    <x-card>
        <x-secondary-button @click="creating=!creating">Create new fixtures</x-secondary-button>
    </x-card>

    <x-card x-show="creating" title="Create fixtures">
        {{ $this->form }}
        <x-secondary-button class="mt-3" wire:click="generateFixtures">Create fixtures</x-secondary-button>
    </x-card>

    <x-card title="Pending fixtures">
        @foreach($pendingFixtures as $fixture)

            <div class="flex justify-between listed -mx-5 px-5 relative">
                <div>
                    <p>{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }}</p>
                    <p class="text-sm text-gray-500">{{ $fixture->kickoff_at->format('d/m/Y H:i') }}</p>
                </div>
                <div x-data="{clicked: false}" class="pr-10">
                    @if($fixture->scoresMatch)
                        <x-primary-button wire:click="acceptFixture({{ $fixture->id }})" x-show="!clicked" @click="clicked = true">Approve {{ $fixture->proppedScore }}</x-primary-button>
                        <x-primary-button x-show="clicked" class="opacity-30" disabled>System Processing</x-primary-button>
                    @endif

                        <div x-data="{open: false}" class="absolute top-0 right-0">
                            <button @click="open = true" class="text-gray-400 p-2">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>

                            <div @click.outside="open = false" x-show="open" class="absolute w-[250px] top-6 right-0">
                                <div class="bg-white border border-gray-300 shadow-md rounded-md">
                                    <button wire:click="unprop('home', {{ $fixture->id }})" class="px-3 py-3 hover:bg-gray-100 rounded-md block w-full text-left">Unprop Home</button>
                                    <button wire:click="unprop('away', {{ $fixture->id }})" class="px-3 py-3 hover:bg-gray-100 rounded-md block w-full text-left">Unprop Away</button>
                                    <a href="{{ route('admin.fixtures.default', $fixture->id) }}" class="px-3 py-3 hover:bg-gray-100 rounded-md block w-full text-left">Default score</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        @endforeach
    </x-card>

    <x-card title="Fixtures">
        @foreach($fixtures as $fixture)

            <div class="flex justify-between listed -mx-5 px-5 relative">
                <div>
                    <p>{{ $fixture->homeClub->name }} vs {{ $fixture->awayClub->name }}</p>
                    <p class="text-sm text-gray-500">{{ $fixture->kickoff_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <a class="mr-5" wire:navigate href="{{ route('admin.fixtures.edit', $fixture->id) }}">Edit</a>
                </div>
                <div x-data="{open: false}" class="absolute top-0 right-0">
                    <button @click="open = true" class="text-gray-400 p-2">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                    <div @click.outside="open = false" x-show="open" class="absolute w-[250px] top-6 right-0">
                        <div class="bg-white border border-gray-300 shadow-md z-50 relative rounded-md">
                            <a href="{{ route('admin.fixtures.default', $fixture->id) }}" class="px-3 py-3 hover:bg-gray-100 rounded-md block w-full text-left">Default score</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </x-card>

</div>
