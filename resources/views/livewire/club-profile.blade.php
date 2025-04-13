@php use App\Enum\FixtureStatus; @endphp
<div class="-mt-10">

    <header class="bg-gradient-to-r from-blue-800 via-blue-600 to-blue-800 text-white">
        <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ $club->getFirstMediaUrl('logo') }}" alt="Club Logo" class="w-16 h-16 object-contain rounded-full" />
                <h1 class="text-3xl font-bold">{{ $club->name }}</h1>
            </div>
        </div>
        <!-- Horizontal stripe as a design divider -->
    </header>

    <!-- Manager Section -->
    <section class="bg-white">
        <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col md:flex-row items-center">
            @if($club->manager)
                <img src="{{ $club->manager->getFirstMediaUrl('image') }}" alt="Manager" class="w-24 h-24 object-cover rounded-full border-4 border-blue-600" />
                <div class="mt-4 md:mt-0 md:ml-6">
                    <h2 class="text-2xl font-bold">Team Manager</h2>
                    <p class="mt-2 text-gray-600">{{ $club->manager->name }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Recent Form Section -->
    <section class="bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-4">Recent Form</h2>
            <div class="flex space-x-4">
                <!-- Example result icons -->
                @foreach($club->form as $result)
                    <div class="w-12 h-12 flex items-center justify-center

                        @if($result == 'W')
                            bg-green-500
                        @elseif($result == 'D')
                            bg-yellow-500
                        @else
                            bg-red-500
                        @endif
                        text-white
                        hover:bg-opacity-80 transition duration-300
                        shadow-lg
                        transform hover:scale-105
                        flex items-center justify-center

                     text-gray-800 font-bold rounded-full">
                        @if($result == 'W')
                            W
                        @elseif($result == 'D')
                            D
                        @else
                            L
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Player Roster Section -->
    <section class="bg-white">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-6">Player Roster</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Player Card -->
                @foreach($club->players as $player)
                    <div class="bg-gray-50 p-4 rounded-lg shadow hover:shadow-lg transition">
                        <img src="{{ $player->image }}" alt="Player 1" class="h-16 w-16 object-cover rounded-full" />
                        <h3 class="mt-4 font-semibold">{{ $player->name }}</h3>
                        <p class="text-sm text-gray-600">Since Season {{ $player->currentContract->season }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Upcoming Fixtures Section -->
    <section class="bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-4">Fixtures</h2>
            <div class="space-y-4">
                <!-- Fixture Card -->
                @foreach($club->fixtures as $fixture)
                    <div class="flex items-center justify-between bg-white p-4 rounded-lg shadow">
                        <div>
                            <h3>
                                <span class="font-semibold">
                                {{ $fixture->homeClub->name }}
                                </span>
                                <span class="underline">{{ $fixture->status === FixtureStatus::Completed ? $fixture->proppedScore : 'vs' }}</span>
                                <span class="font-semibold">
                                {{ $fixture->awayClub->name }}
                                </span>
                            </h3>
                            <p class="text-sm text-gray-600">April 20, 2025 | 7:00 PM</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
