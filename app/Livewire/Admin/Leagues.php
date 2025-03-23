<?php

namespace App\Livewire\Admin;

use App\Enum\LeagueStatus;
use App\Models\League;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Livewire\WithFileUploads;

class Leagues extends Component implements HasForms
{

    use WithFileUploads, InteractsWithForms;
    public ?array $formFields;
    public $leagues;
    public $primaryImage;


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('status')->options(LeagueStatus::class)->required(),
                TextInput::make('season')->numeric()->required(),
                Textarea::make('description')->required()->hint('Shown on the league page.'),
                FileUpload::make('logo')->required(),
            ])->statePath('formFields');
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function storeLeague()
    {

        $league = League::create($this->form->getState());

        $logo = $this->form->getState()['logo'];

        // Add the logo to the clubs media
        $league->addMedia(storage_path('app/public/'. $logo))
            ->toMediaCollection('logo');

        $this->form->fill();


        $this->dispatch('toast', 'League created successfully');

    }

    public function render()
    {

        $this->leagues = League::get(['name', 'id']);

        return view('livewire.admin.leagues')->layout('layouts.admin');
    }
}
