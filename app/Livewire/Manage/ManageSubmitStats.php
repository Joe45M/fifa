<?php

namespace App\Livewire\Manage;

use App\Models\Fixture;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageSubmitStats extends Component
{

    public $stats = [
        'goals',
        'assists',
        'tackles',
        'passes',
        'shots',
        'yellow_cards',
        'red_cards',
    ];


    public Fixture $fixture;
    public $players;

    public $fieldedPlayers = [];
    public $step = 'players';

    public function mount(Fixture $fixture)
    {

        $this->players = Auth::user()->currentContract->club->players()
            ->get(['users.id', 'users.name']);

        $this->fixture = $fixture;
    }


    public function render()
    {
        return view('livewire.manage.manage-submit-stats')->layout('layouts.manage');
    }

    public function nextStep(string $step)
    {
        $this->step = $step;

        if ($step === 'stats') {
            $this->fieldedPlayers = $this->players->whereIn('id', $this->fieldedPlayers);
        }

        $this->render();
    }
}
