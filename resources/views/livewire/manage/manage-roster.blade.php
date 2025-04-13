@php use App\Enum\ContractType; @endphp
<div class="grid lg:grid-cols-4 gap-5">
    @foreach($players as $player)
        <x-card class="relative">

            <div x-data="{open: false}" class="absolute top-4 right-4">
                <button @click="open = true" class="text-gray-400 p-2">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>

                <div @click.outside="open = false" x-show="open" class="absolute w-[250px] top-6 right-0">
                    <div class="bg-white border border-gray-300 shadow-md rounded-md">
                        @if($player->currentContract->type === ContractType::Player)
                            <button wire:click="toggleCoManager({{ $player->currentContract->id }})" class="w-full p-3 text-left hover:bg-gray-100">Promote as Co-Manager</button>
                        @endif

                        @if($player->currentContract->type === ContractType::CoManager)
                            <button wire:click="toggleCoManager({{ $player->currentContract->id }})" class="w-full p-3 text-left hover:bg-gray-100">Demote from Co-Manager</button>
                        @endif

                            <button wire:click="release({{ $player->currentContract->id }})" class="w-full p-3 text-left hover:bg-gray-100 text-red-400">Release player</button>

                    </div>
                </div>
            </div>


            <div class="flex gap-5 items-center">
                <img src="{{ $player->image }}" alt="Profile image" class="w-14 h-14 rounded-full bg-red object-contain">
                <span class="text-[24px]">{{ $player->name }}</span>
            </div>
        </x-card>
    @endforeach
</div>
