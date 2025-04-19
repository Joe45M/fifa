<?php

namespace App\Livewire;

use App\Models\UserStat;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Url;
use Livewire\Component;

class Leaderboards extends Component
{

    public $stat;

    public $table;

    public $options = [
        'goals',
        'tackles',
        'assists',
        'saves',
    ];

    public function mount(string $stat)
    {
        $this->table = Cache::flexible($stat . '1', [600, 900], function () {
            $this->stat = $stat ?? 'goals';

            $calculatedStats = [];

            $stats = UserStat::where('stat', $this->stat)
                ->where('value', '>', 0)
                ->get(['user_id', 'stat', 'value'])
                ->groupBy('user_id');

            foreach ($stats as $group) {

                $group->first()->load('user');

                $total = [
                    'sum' => $group->sum('value'),
                    'user_name' => $group->first()->user->name,
                    'user_id' => $group->first()->user->id,
                ];

                $calculatedStats[] = $total;
            }

            return collect($calculatedStats)->sortByDesc('sum');
        });
    }

    public function render()
    {
        return view('livewire.leaderboards')->layout('layouts.app');
    }
}
