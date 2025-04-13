<div>
    <div class="container mx-auto">
        <x-card padding="{{ false }}" title="{{ $league->name }}">
            <table class="table w-full">
                <thead class="listed">
                    <tr>
                        <th class="text-left pl-5 pb-3 text-left py-3">Club</th>
                        <th class="text-left pb-3 text-left py-3">GP</th>
                        <th class="text-left pr-5 pb-3 text-left py-3">Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($table as $team)
                        <tr class="listed">
                            <td class="text-left pl-5 py-3">
                                <a href="{{ route('club', $team->name) }}" class="flex gap-3 items-center">
                                    <img
                                        class="w-6 h-6 object-contain"
                                        src="{{ $team->getFirstMediaUrl('logo') }}" alt="Team logo">
                                    {{ $team->name }}
                                </a>
                            </td>
                            <td class="text-left pr-5 py-3">{{ $team->gamesPlayedThisSeason }}</td>
                            <td class="text-left pr-5 py-3">{{ $team->pointsThisSeason }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    </div>
</div>
