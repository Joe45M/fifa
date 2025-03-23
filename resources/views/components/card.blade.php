<div {{ $attributes->merge(['class' => 'bg-white p-5 rounded-md mb-5']) }}>

    @if($title)
        <h3 class="text-2xl font-bold uppercase mb-5">{{ $title }}</h3>
    @endif

    {{ $slot }}
</div>
