<?php

namespace App\Livewire\Admin;

use App\Enum\ClubStatus;
use App\Enum\LeagueStatus;
use App\Models\Club;
use App\Models\League;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Clubs extends Component implements HasForms
{
    use \Livewire\WithFileUploads, \Filament\Forms\Concerns\InteractsWithForms;

    public ?array $formFields;

    public $clubs;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('status')->options(ClubStatus::class)->required(),
                FileUpload::make('logo'),
                Select::make('league_id')
                    ->options(League::get()->pluck('name', 'id')->toArray())
                    ->label('League')
                    ->required(),
            ])->statePath('formFields');
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function storeClub()
    {

        $club = Club::create($this->form->getState());

        $logo = $this->form->getState()['logo'];

        // Add the logo to the clubs media
        $club->addMedia(storage_path('app/public/'. $logo))
            ->toMediaCollection('logo');

    }

    public function render()
    {
        $this->clubs = Club::all();
        return view('livewire.admin.clubs')->layout('layouts.admin');
    }
}
