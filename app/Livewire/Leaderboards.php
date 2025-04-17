<?php

namespace App\Livewire;

use App\Models\UserStat;
use Livewire\Attributes\Url;
use Livewire\Component;

class Leaderboards extends Component
{

    public $stat;

    public function mount(string $stat)
    {
        $this->stat = $stat ?? 'goals';

        $stats = UserStat::where('stat', $this->stat)
            ->where('value', '>', 0)
            ->get('user_id', 'stat', 'value');

        dd($stats->count());
    }

    public function render()
    {
        return view('livewire.leaderboards')->layout('layouts.app');
    }
}
