<?php

namespace App\Livewire\Admin;

use App\Enum\FixtureStatus;
use App\Enum\FixtureType;
use App\Enum\LeagueStatus;
use App\Models\Club;
use App\Models\Fixture;
use App\Models\League;
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

    use InteractsWithForms;
    public ?array $formFields;

    public $fixtures;

    public function mount()
    {
        $this->form->fill();
    }

    public function render()
    {

        $this->fixtures = Fixture::with('homeClub', 'awayClub')->get(['id', 'kickoff_at', 'home_club_id', 'away_club_id', 'type', 'status', 'season']);
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
}
