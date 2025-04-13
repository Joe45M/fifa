<?php

namespace App\Livewire\Manage;

use App\Jobs\SubmitsStatsJob;
use App\Models\Fixture;
use App\Models\User;
use App\Traits\UseToast;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageSubmitStats extends Component
{

    use UseToast;
    public $homeScore = null;
    public $awayScore = null;

    public $stats = [
        'goals' => 0,
        'assists' => 0,
        'tackles' => 0,
        'passes'  => 0,
        'shots' => 0,
        'yellow_cards' => 0,
        'red_cards' => 0,
    ];

    public $currentPlayer = null;

    public $playerIndex = 0;

    public $trackedStats;

    public $storedStats = [];


    public Fixture $fixture;
    public $players;

    public $fieldedPlayers = [];
    public $step = 'players';
    /**
     * @var true
     */
    public bool $isLastPlayer = false;

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

        if ($step === 'score') {
            $this->nextPlayer();
        }

        if ($step === 'stats') {
            $this->fieldedPlayers = User::whereIn('id', $this->fieldedPlayers)->get();
            $this->nextPlayer();
        }

        $this->render();
    }

    public function nextPlayer()
    {

        if ($this->currentPlayer == null) {
            $this->currentPlayer = $this->fieldedPlayers->first();
        } else {
            $this->storedStats[$this->currentPlayer->id] = $this->trackedStats;

            if (!$this->isLastPlayer) {
                $this->playerIndex = $this->playerIndex + 1;
                $this->currentPlayer = $this->fieldedPlayers[$this->playerIndex];
            }

        }

        $this->trackedStats = $this->stats;

        if ($this->isLastPlayer) {
            return false;
        }


        if (($this->playerIndex + 1) >= $this->fieldedPlayers->count()) {
            $this->isLastPlayer = true;
        }

        $this->render();
    }

    public function submit()
    {

        $this->validate(['homeScore' => 'required|integer', 'awayScore' => 'required|integer']);

        $stats = [
            'fixture' => $this->fixture,
            'stats' => $this->storedStats,
            'score' => [
                'home' => $this->homeScore,
                'away' => $this->awayScore,
            ],
        ];

        SubmitsStatsJob::dispatch($stats);

        $this->step = 'complete';
        $this->render();
    }

    public function navigate($url)
    {
        return $this->redirect($url);
    }
}
