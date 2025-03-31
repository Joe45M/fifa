<?php

namespace App\Livewire\Admin;

use App\Enum\ContractStatus;
use App\Enum\ContractType;
use App\Enum\LeagueStatus;
use App\Models\Club;
use App\Models\Contract;
use App\Models\League;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Livewire\WithFileUploads;

class Contracts extends Component implements HasForms
{

    use WithFileUploads, InteractsWithForms;
    public ?array $formFields;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search) => User::where('name', 'like', "%{$search}%")->limit(10)->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name),

                TextInput::make('games_remaining')
                    ->numeric()
                    ->label('Contract Length')
                    ->default(50)
                    ->hint('Number of games on the contract')
                    ->required(),

                Select::make('club_id')
                    ->label('Club')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search) => Club::where('name', 'like', "%{$search}%")->limit(10)->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => Club::find($value)?->name),
            ])->statePath('formFields');
    }

    public function storeContract()
    {
        $options = [
            'type' => ContractType::Manager,
            'status' => ContractStatus::Active,
            'season' => Club::find($this->form->getState()['club_id'])->league->season,
            'length' => $this->form->getState()['games_remaining'],
        ];

        $contract = Contract::create(array_merge($this->form->getState(), $options));

        $this->dispatch('toast', 'Contract created successfully');
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.admin.contracts')->layout('layouts.admin');
    }
}
