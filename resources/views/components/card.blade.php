<div {{ $attributes->merge(['class' => 'bg-white rounded-md mb-5']) }}>

        @if($title)
        <div class="bg-bg p-3 px-5 rounded-t-md">
            <h3 class="text-[18px] font-bold text-white">{{ $title }}</h3>
        </div>
        @endif

    <div @if($padding) class="p-5" @endif>
        {{ $slot }}
    </div>
</div>
