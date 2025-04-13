<?php

namespace App\Livewire;

use App\Models\Fixture;
use App\Models\UserStat;
use Livewire\Component;

class FixtureDetails extends Component
{

    public $fixture;

    public function mount(Fixture $fixture)
    {
        $this->fixture = $fixture;
    }

    public function render()
    {

        $homeClubStats = UserStat::where('fixture_id', $this->fixture->id)
            ->where('club_id', $this->fixture->home_club_id)
            ->with('user')
            ->get()
            ->groupBy('user_id');

        return view('livewire.fixture-details', [
            'fixture' => $this->fixture,
            'homeClubStats' => $homeClubStats,
            'awayClubStats' => UserStat::where('fixture_id', $this->fixture->id)
                ->where('club_id', $this->fixture->away_club_id)
                ->with('user')
                ->get()
                ->groupBy('user_id'),
        ])->layout('layouts.app');
    }

}
