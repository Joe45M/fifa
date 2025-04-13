@php use App\Enum\ContractStatus; @endphp
<div class="bg-gray-100 dark:bg-gray-900" x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        activeTab: 'stats',
        playerStats: {
            goals: {{ $user->goals()->sum('value') }},
            assists: {{ $user->assists()->sum('value') }},
            tackles: {{ $user->tackles()->sum('value') }},
            passes: {{ $user->passes()->sum('value') }},
            shots: {{ $user->shots()->sum('value') }},
            yellow_cards: {{ $user->yellowCards()->sum('value') }},
            red_cards: {{ $user->redCards()->sum('value') }},
            assists: {{ $user->assists()->sum('value') }},
            matches: {{ $user->played }},
        }
    }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">

<!-- Profile Banner and Basic Info -->
<div class="relative">
    <!-- Banner Image -->
    <div class="h-80 w-full overflow-hidden">
        <img src="https://images.unsplash.com/photo-1522778526097-ce0a22ceb253?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Banner" class="w-full object-cover object-center">
    </div>

    <!-- Profile Image & Basic Info - Overlapping Banner -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative -mt-24">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <!-- Profile Image -->
                    <div class="sm:flex sm:space-x-5">
                        <div class="flex-shrink-0 mr-5">
                            <img class="mx-auto h-32 w-32 rounded-full border-4 border-white dark:border-gray-700 object-cover"
                                 src="{{ $user->image }}" alt="Player Avatar  fifa pro clubs league">
                        </div>

                        <!-- Basic Info -->
                        <div class="mt-4 sm:mt-0 ml-10 sm:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">{{ $user->name }}</h1>
                            @if($user->currentContract)
                                <div class="flex items-center mt-2">
                                    <img src="{{ $user->currentContract->club->getFirstMediaUrl('logo') }}" alt="Club Logo" class="h-6 w-6 rounded-full">
                                    <a href="{{ route('club', $user->currentContract->club->name) }}" class="ml-2 text-lg text-gray-700 dark:text-gray-300">{{ $user->currentContract->club->name }}</a>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Since season {{ $user->currentContract->season }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-5 flex justify-center sm:mt-0">
                        <a href="#" class="flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-fifa-accent hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Tabs -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="flex space-x-8">
            <button @click="activeTab = 'stats'" :class="{'border-fifa-accent text-fifa-accent': activeTab === 'stats', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'stats'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Statistics
            </button>
{{--            <button @click="activeTab = 'matches'" :class="{'border-fifa-accent text-fifa-accent': activeTab === 'matches', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'matches'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">--}}
{{--                Match History--}}
{{--            </button>--}}
            <button @click="activeTab = 'clubs'" :class="{'border-fifa-accent text-fifa-accent': activeTab === 'clubs', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'clubs'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Club History
            </button>
{{--            <button @click="activeTab = 'achievements'" :class="{'border-fifa-accent text-fifa-accent': activeTab === 'achievements', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== 'achievements'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">--}}
{{--                Achievements--}}
{{--            </button>--}}
        </nav>
    </div>
</div>

<!-- Content Based on Active Tab -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Statistics Tab -->
    <div x-show="activeTab === 'stats'" class="space-y-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Player Performance Statistics</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Career totals across all clubs</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Matches Played</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white" x-text="playerStats.matches"></dd>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Goals</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white" x-text="playerStats.goals"></dd>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Assists</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white" x-text="playerStats.assists"></dd>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Tackles</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white" x-text="playerStats.tackles"></dd>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Passes</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white" x-text="playerStats.passes"></dd>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Match History Tab -->
    <div x-show="activeTab === 'matches'" class="space-y-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Recent Matches</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Last 5 competitive matches</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-green-100 dark:bg-green-800 rounded-md">
                                        <span class="text-green-800 dark:text-green-100 font-semibold">W</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Legendary FC 3 - 1 Ultimate Stars
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Division 1 • April 8, 2025
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-3">
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">2</span> Goals
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">1</span> Assist
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">9.2</span> Rating
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-red-100 dark:bg-red-800 rounded-md">
                                        <span class="text-red-800 dark:text-red-100 font-semibold">L</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Legendary FC 1 - 2 Pro Eleven
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Division 1 • April 5, 2025
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-3">
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">1</span> Goal
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">0</span> Assists
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">8.4</span> Rating
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-yellow-100 dark:bg-yellow-800 rounded-md">
                                        <span class="text-yellow-800 dark:text-yellow-100 font-semibold">D</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            FC Global 2 - 2 Legendary FC
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Division 1 • April 3, 2025
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-3">
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">0</span> Goals
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">2</span> Assists
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span class="text-fifa-accent mr-1">8.7</span> Rating
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Club History Tab -->
    <div x-show="activeTab === 'clubs'" class="space-y-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Club History</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Career progression across clubs</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($user->contracts as $contract)
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="h-12 w-12 rounded-full object-contain" src="{{ $contract->club->getFirstMediaUrl('logo') }}" alt="Club Logo">
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <a href="{{ route('club', $contract->club->name) }}" class="text-lg font-medium text-gray-900 dark:text-white">{{ $contract->club->name }}</a>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Season {{ $contract->season }}</p>
                                            </div>
                                            @if($contract->status === ContractStatus::Active)
                                                <div class="bg-green-100 dark:bg-green-800 py-1 px-3 rounded-full">
                                                    <p class="text-xs text-green-800 dark:text-green-100">Current</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Achievements Tab -->
    <div x-show="activeTab === 'achievements'" class="space-y-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Achievements & Trophies</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Career accomplishments</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="px-4 py-4 sm:px-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">Division 1 Champion</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Season 24/25 with Legendary FC</p>
                            </div>
                        </div>
                    </li>
                    <li class="px-4 py-4 sm:px-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">Top Goalscorer</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Season 23/24 with Pro Eleven (32 Goals)</p>
                            </div>
                        </div>
                    </li>
                    <li class="px-4 py-4 sm:px-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">100 Career Goals</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Achieved on March 15, 2024</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
