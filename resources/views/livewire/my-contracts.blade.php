@php use App\Enum\ContractStatus;use Illuminate\Support\Facades\Auth; @endphp
<div>
    <div class="container mx-auto">
        <x-card title="My contracts">
            @foreach($contracts->sortByDesc('created_at') as $contract)
                <div class="bg-white p-5 listed -mx-5 px-5">
                    <div class="flex flex-wrap gap-3 justify-between">
                        <div>
                            <div class="font-bold flex gap-2 items-center">

                                <img src="{{ $contract->club->getFirstMediaUrl('logo') }}" alt="Club logo"
                                     class="w-5 h-5 object-contain">

                                {{ $contract->club->name }}
                            </div>
                            <div class="text-sm">{{ $contract->club->city }}</div>
                        </div>
                        <div>
                            <div class="text-sm font-bold capitalize">{{ $contract->status }}</div>
                            <div class="text-sm">Season {{ $contract->season }}</div>
                        </div>

                        @if($contract->status == 'offered' && Auth::user()->currentContract)
                            <div class="justify-self-end self-center flex gap-3">
                                <x-secondary-button wire:click="rejectOffer({{ $contract->id }})" wire:confirm
                                                    class="w-full text-center justify-center">Reject contract
                                </x-secondary-button>
                                <x-primary-button wire:click="acceptOffer({{ $contract->id }})" wire:confirm
                                                  class="w-full text-center justify-center">Accept contract
                                </x-primary-button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </x-card>

    </div>
</div>
