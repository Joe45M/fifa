<?php

namespace App\Livewire\Admin;

use App\Enum\LeagueStatus;
use App\Models\League;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditLeague extends Component implements HasForms
{

    use InteractsWithForms, WithFileUploads;
    public $formFields;
    public League $league;


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Select::make('status')->options(LeagueStatus::class)->required(),
                TextInput::make('season')->numeric()->required(),
                Textarea::make('description')->required()->hint('Shown on the league page.'),
                SpatieMediaLibraryFileUpload::make('logo')->collection('logo'),
            ])
            ->statePath('formFields')
            ->model($this->league);
    }

    public function mount(League $league)
    {
        $this->league = $league;
        $this->form->fill($this->league->toArray());
    }

    public function storeLeague()
    {
        $league = $this->league->update($this->form->getState());

        $this->dispatch('toast', 'League updated.');
    }

    public function render()
    {
        return view('livewire.admin.edit-league')->layout('layouts.admin');
    }
}
