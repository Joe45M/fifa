<div>
    <div class="container mx-auto">
        <div class="grid gap-5 grid-cols-2 lg:grid-cols-7">
            @if(auth()->user()->manager)
                <a wire:navigate href="{{ route('manage.dashboard') }}" class="bg-bg hover:bg-dark aspect-square justify-center rounded-xl flex items-center text-white text-white">
                    <div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-user-tie text-4xl mb-3"></i>
                        </div>
                        <div class="block text-center w-full">Manage team</div>
                    </div>
                </a>
            @endif
            @if(auth()->user()->currentContract)
                <a wire:navigate href="{{ route('league', auth()->user()->currentContract?->club?->league->id) }}" class="bg-bg hover:bg-dark aspect-square justify-center rounded-xl flex items-center text-white text-white">
                    <div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-table text-4xl mb-3"></i>
                        </div>
                        <div class="block text-center w-full">League table</div>
                    </div>
                </a>
            @endif
            <a wire:navigate href="{{ route('my-contracts') }}" class="bg-bg hover:bg-dark aspect-square justify-center rounded-xl flex items-center text-white text-white">
                <div>
                    <div class="flex justify-center">
                        <i class="fa-solid fa-file-contract text-4xl mb-3"></i>
                    </div>
                    <div class="block text-center w-full">My contracts</div>
                </div>
            </a>
            <a wire:navigate href="{{ route('user.profile', auth()->user()->name) }}" class="bg-bg hover:bg-dark aspect-square justify-center rounded-xl flex items-center text-white text-white">
                <div>
                    <div class="flex justify-center">
                        <i class="fa-solid fa-user text-4xl mb-3"></i>
                    </div>
                    <div class="block text-center w-full">My profile</div>
                </div>
            </a>
            <a wire:navigate href="{{ route('profile') }}" class="bg-bg hover:bg-dark aspect-square justify-center rounded-xl flex items-center text-white text-white">
                <div>
                    <div class="flex justify-center">
                        <i class="fa-solid fa-user-pen text-4xl mb-3"></i>
                    </div>
                    <div class="block text-center w-full">Edit profile</div>
                </div>
            </a>
        </div>
    </div>
</div>
