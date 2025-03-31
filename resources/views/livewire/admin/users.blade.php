<div>
    <x-card title="Manage Users">

        <div class="mb-5">
            <x-text-input placeholder="Search by name" wire:model.live="search" wire:change="search"></x-text-input>
        </div>

        @foreach ($users as $user)
            <div class="gap-5 listed -mx-5 px-5">
                    <div>{{ $user->name }}</div>
                    <div>{{ $user->email }}</div>
                    <div>
                        <x-secondary-button wire:click="impersonate({{ $user->id }})">Impersonate</x-secondary-button>
                    </div>
                </tr>
            </div>
        @endforeach

        <div class="flex gap-5">
            {{ $users->links() }}
        </div>
    </x-card>
</div>
