<div>
    <div class="container mx-auto">

        <div class="mb-5">
            <h1 class="text-2xl font-bold">Leaderboards</h1>
            <p class="text-gray-600">View the top players for {{ $stat }}.</p>
            <div class="flex">
                <span class="text-gray-600 pr-4">
                    All stats:
                </span>
                @foreach($options as $option)
                    <a href="{{ route('leaderboards', ['stat' => $option]) }}" class="btn btn-sm {{ $stat === $option ? 'btn-primary' : 'btn-secondary' }} mr-2">
                        {{ $option }}
                    </a> {!! $loop->last ? '' : '<span class="pr-3">/</span>' !!}
                @endforeach
            </div>
        </div>

        <x-card title="{{ $stat }} leaderboards">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                    <tr>
                        <th class="text-left">Rank</th>
                        <th class="text-left">Player</th>
                        <th class="text-left">{{ $stat }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($table as $index => $player)
                        <tr class="listed">
                            <td class="py-5">{{ $loop->iteration }}</td>
                            <td class="py-5">
                                <a href="{{ route('user.profile', $player['user_name']) }}" class="underline">{{ $player['user_name'] }}</a>
                            </td>
                            <td class="py-5">{{ $player['sum'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>
