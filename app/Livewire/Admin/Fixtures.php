<?php

namespace App\Livewire\Admin;

use App\Enum\FixtureStatus;
use App\Enum\FixtureType;
use App\Enum\LeagueStatus;
use App\Jobs\AcceptFixtureJob;
use App\Models\Club;
use App\Models\Fixture;
use App\Models\League;
use App\Models\UserStat;
use App\Traits\UseToast;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class Fixtures extends Component implements HasForms
{

    use InteractsWithForms, UseToast;
    public ?array $formFields;

    public $fixtures;
    public \Illuminate\Database\Eloquent\Collection $pendingFixtures;

    public function mount()
    {
        $this->form->fill();
    }

    public function render()
    {

        $this->fixtures = Fixture::with('homeClub', 'awayClub')->get(['id', 'kickoff_at', 'home_club_id', 'away_club_id', 'type', 'status', 'season']);
        $this->pendingFixtures = Fixture::with('homeClub', 'awayClub')->where('status', FixtureStatus::Pending)->get(['id', 'kickoff_at', 'home_club_id', 'away_club_id', 'type', 'status', 'season']);
        return view('livewire.admin.fixtures')->layout('layouts.admin');
    }


    public function generateFixtures()
    {
        $form = $this->form->getState();

        Fixture::create([
            'league_id' => $form['league_id'],
            'kickoff_at' => $form['date'],
            'home_club_id' => intval($form['home_team_id']),
            'away_club_id' => intval($form['away_team_id']),
            'type' => FixtureType::League,
            'status' => FixtureStatus::Unplayed,
            'season' => League::find($form['league_id'])->season,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('league_id')
                    ->options(League::get()->pluck('name', 'id')->toArray())
                    ->label('League')
                    ->required(),
                DateTimePicker::make('date')->required(),
                Select::make('home_team_id')
                    ->options(Club::get()->pluck('name', 'id')->toArray())
                    ->label('Home Team')
                    ->required(),
                Select::make('away_team_id')
                    ->options(Club::get()->pluck('name', 'id')->toArray())
                    ->label('Away Team')
                    ->required(),
            ])->statePath('formFields');
    }

    public function acceptFixture(Fixture $fixture)
    {
        if ($fixture->status === FixtureStatus::Completed || $fixture->status === FixtureStatus::Processing) {
            $this->toast('Fixture already completed', 'error');

            return false;
        }

        $fixture->status = FixtureStatus::Processing;
        $fixture->save();

        $this->toast('System has began processing', 'success');
        AcceptFixtureJob::dispatch($fixture);
    }

    public function unprop(string $location, Fixture $fixture)
    {
        if ($location === 'home') {
            $club = $fixture->homeClub;
        } elseif ($location === 'away') {
            $club = $fixture->awayClub;
        }

        $fixture->fixtureMeta()->where('meta_key', $location . '_propped')->delete();
        $fixture->fixtureMeta()->where('meta_key', $location . '_propped_score')->delete();

        UserStat::where('fixture_id')->where('club_id', $club->id)->delete();

        $fixture->status = FixtureStatus::Unplayed;
        $fixture->save();
        $this->toast('Fixture unpropped', 'success');


    }
}
