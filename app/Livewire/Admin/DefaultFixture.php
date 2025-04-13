<?php

namespace App\Livewire\Admin;

use App\Enum\FixtureStatus;
use App\Enum\LeagueStatus;
use App\Enum\StatStatus;
use App\Models\Fixture;
use App\Models\FixtureMeta;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class DefaultFixture extends Component implements HasForms
{
    use \Filament\Forms\Concerns\InteractsWithForms;

    public ?array $formFields;
    public Fixture $fixture;
    public $updated = false;

    public function mount(Fixture $fixture)
    {
        $this->fixture = $fixture;

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('home_score')->numeric()->required(),
                TextInput::make('away_score')->numeric()->required(),
            ])->statePath('formFields');
    }



    public function render()
    {
        return view('livewire.admin.default-fixture')->layout('layouts.admin');
    }

    public function submit()
    {
        $scores = $this->form->getState();

        $this->fixture->fixtureMeta()->delete();

        FixtureMeta::create([
            'fixture_id' => $this->fixture->id,
            'meta_key' => 'home_propped_score',
            'meta_value' => $scores['home_score'] . '-' . $scores['away_score'],
        ]);

        FixtureMeta::create([
            'fixture_id' => $this->fixture->id,
            'meta_key' => 'home_propped',
            'meta_value' => 1,
        ]);

        FixtureMeta::create([
            'fixture_id' => $this->fixture->id,
            'meta_key' => 'away_propped_score',
            'meta_value' => $scores['home_score'] . '-' . $scores['away_score'],
        ]);

        FixtureMeta::create([
            'fixture_id' => $this->fixture->id,
            'meta_key' => 'away_propped',
            'meta_value' => 1,
        ]);

        $this->fixture->update([
            'status' => FixtureStatus::Pending,
        ]);

        $this->fixture->stats()->update([
            'status' => StatStatus::Active,
        ]);

        $this->updated = true;

        $this->dispatch('toast', 'Fixture updated successfully');
    }
}
