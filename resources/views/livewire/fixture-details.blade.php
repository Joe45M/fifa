@php use App\Enum\FixtureStatus; @endphp
<div>
    <div class="container mx-auto">
        <x-card>
            <div class="flex lg:w-[500px] mx-auto justify-between mb-5 gap-16">
                <div>
                    <a href="{{ route('club', $fixture->homeClub->name) }}" class="pb-5">
                        <img src="{{ $fixture->homeClub->getFirstMediaUrl('logo') }}" alt="{{ $fixture->homeClub->name }} logo" class="w-16 mx-auto object-contain h-16 rounded-full">
                        <p class="text-center mt-5 text-3xl text-gray-500">
                            {{ $fixture->homeClub->name }}
                        </p>
                    </a>


                    @foreach($homeClubStats as $statGroup)
                        @foreach($statGroup as $stat)
                            <div>
                                @if($loop->first)

                                    <a href="{{ route('user.profile', $stat->user->name) }}" class="font-bold block mt-5">
                                        {{ $stat->user->name }}
                                    </a>
                                @endif

                                <div class="flex justify-between listed">
                                    {{ $stat->stat }}
                                    <span>
                                    {{ $stat->value }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                </div>

                @if($fixture->status === FixtureStatus::Completed)
                    <div>
                        <p class="text-center mt-5 text-3xl text-gray-500">
                            {{ $fixture->proppedScore }}
                        </p>
                        <p class="text-center mt-5 text-lg text-gray-500">
                            {{ $fixture->kickoff_at->format('d/m/Y') }}
                        </p>
                    </div>
                @endif

                <div>
                    <a href="{{ route('club', $fixture->awayClub->name) }}">
                        <img src="{{ $fixture->awayClub->getFirstMediaUrl('logo') }}" alt="{{ $fixture->awayClub->name }} logo" class="w-16 mx-auto object-contain h-16 rounded-full">
                        <p class="text-center mt-5 text-3xl text-gray-500">
                            {{ $fixture->awayClub->name }}
                        </p>
                    </a>

                    @foreach($awayClubStats as $statGroup)
                        @foreach($statGroup as $stat)
                            <div>
                                @if($loop->first)
                                    <a href="{{ route('user.profile', $stat->user->name) }}" class="font-bold block mt-5">
                                        {{ $stat->user->name }}
                                    </a>
                                @endif

                                <div class="flex justify-between listed">
                                    {{ $stat->stat }}
                                    <span>
                                    {{ $stat->value }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </x-card>
    </div>
</div>
