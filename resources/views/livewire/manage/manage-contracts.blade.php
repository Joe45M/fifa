<div class="gap-y-5">
    <x-card title="Send a contract offer">

        {{ $this->form }}

        <div class="mt-5">
            <x-secondary-button wire:click="sendContract">Send contract</x-secondary-button>
        </div>

    </x-card>

    <x-card title="Outgoing contract offers">
        @if($outgoingContracts->count())

            <div class="grid grid-cols-1 gap-5">
                @foreach($outgoingContracts as $contract)
                    <div class="bg-white p-5 rounded-md listed -mx-5 px-5">
                        <div class="flex flex-wrap gap-3 justify-between">
                            <div>
                                <div class="font-bold">{{ $contract->user->name }}</div>
                                <div class="text-sm">{{ $contract->club->name }}</div>
                            </div>
                            <div>
                                <div class="text-sm font-bold">{{ $contract->status }}</div>
                                <div class="text-sm">{{ $contract->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="justify-self-end">
                                <x-secondary-button wire:click="rescindOffer({{ $contract->id }})" wire:confirm class="w-full text-center justify-center">Rescind offer</x-secondary-button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </x-card>
</div>
