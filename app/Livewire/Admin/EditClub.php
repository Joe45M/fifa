<?php

namespace App\Livewire\Admin;

use App\Enum\ClubStatus;
use App\Enum\ContractStatus;
use App\Models\Club;
use App\Models\Contract;
use App\Models\League;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditClub extends Component implements HasForms
{
    use WithFileUploads, InteractsWithForms;

    public ?array $formFields;

    public $club;

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

    public function mount(Club $club)
    {
        $this->club = $this->club;
        $this->form->fill($this->club->toArray());
    }

    public function editClub()
    {
        $this->club->update($this->form->getState());
        $logo = $this->form->getState()['logo'] ?? false;

        // Add the logo to the clubs media
        if ($logo) {
            $this->club->addMedia(storage_path('app/public/' . $logo))
                ->toMediaCollection('logo');
        }

        $this->dispatch('toast', 'Club updated.');
    }

    public function render()
    {
        return view('livewire.admin.edit-club')->layout('layouts.admin');
    }

    public function releasePlayer(Contract $contract)
    {
        $contract->update(['status' => ContractStatus::Inactive]);

        $this->dispatch('toast', 'Player released.');
    }
}
