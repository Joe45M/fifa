<?php

namespace App\Livewire;

use App\Actions\GetLeagueTableByPoints;
use App\Models\League;
use Livewire\Component;

class LeagueTable extends Component
{
    public $table;

    public $league;

    public function mount(League $league)
    {
        $this->league = $league;
    }

    public function render()
    {

        $this->table = GetLeagueTableByPoints::get($this->league);

        return view('livewire.league-table')->layout('layouts.app');
    }
}
