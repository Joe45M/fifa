<div>
    @if(session()->has('impersonate'))
        <div class="flex items-center justify-between bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">You are impersonating {{ auth()->user()->name }}</strong>
            <span class="" wire:click="cancel">
                exit
            </span>
        </div>
    @endif
</div>
