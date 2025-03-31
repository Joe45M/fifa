<?php

namespace App\Livewire\Admin;

use App\Models\Club;
use App\Models\Fixture;
use App\Models\League;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class EditFixture extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $formFields;

    public $fixture;

    public function mount(Fixture $fixture)
    {
        $this->fixture = $fixture;

        $this->form->fill([
            'league_id' => $this->fixture->league_id,
            'date' => $this->fixture->kickoff_at,
            'home_team_id' => $this->fixture->home_club_id,
            'away_team_id' => $this->fixture->away_club_id,
        ]);
    }

    public function saveFixture()
    {

        $update = $this->form->getState();

        $this->fixture->update([
            'league_id' => $update['league_id'],
            'kickoff_at' => $update['date'],
            'home_club_id' => intval($update['home_team_id']),
            'away_club_id' => intval($update['away_team_id']),
        ]);
        $this->dispatch('toast', 'Fixture updated.');
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
            ])->statePath('formFields')
            ->model($this->fixture);
    }

    public function render()
    {
        return view('livewire.admin.edit-fixture')->layout('layouts.admin');
    }
}
