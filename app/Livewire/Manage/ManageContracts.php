<?php

namespace App\Livewire\Manage;

use App\Enum\ContractStatus;
use App\Enum\ContractType;
use App\Enum\LeagueStatus;
use App\Enum\ToastType;
use App\Livewire\Toast;
use App\Models\Club;
use App\Models\Contract;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageContracts extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $formFields;

    public $outgoingContracts;


    public function render()
    {
        $this->outgoingContracts = Auth::user()->currentContract->club->contracts()
            ->offered()
            ->with('user:id,name', 'club:id,name')->get();

        return view('livewire.manage.manage-contracts')->layout('layouts.manage');
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema(  [
                    Select::make('user_id')
                        ->label('Username')
                        ->required()
                        ->searchable()
                        ->getSearchResultsUsing(fn (string $search) => User::where('name', 'like', "%{$search}%")->limit(10)->pluck('name', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name),
                    Select::make('games_remaining')
                        ->label('Contract Length')
                        ->options([
                            10 => '10 Games',
                            25 => '25 Games',
                            50 => '50 Games',
                        ])
                        ->hint('Length of the contract in games.'),
                ])
            ])->statePath('formFields');
    }

    public function rescindOffer(Contract $contract) {
        $contract->delete();
        $this->dispatch('toast', 'Contract offer rescinded.');
    }

    public function sendContract()
    {
        $state = $this->form->getState();

        $user = User::find($state['user_id']);

        $length = $state['games_remaining'];

        if ($user->currentContract) {
            $this->dispatch('toast', 'This player is not a free agent.', ToastType::Error);

            return false;
        }

        Contract::create([
            'user_id' => $user->id,
            'club_id' => auth()->user()->currentContract->club->id,
            'season' => auth()->user()->currentContract->club->league->season,
            'games_remaining' => $length,
            'length' => $length,
            'type' => ContractType::Player,
            'status' => ContractStatus::Offered,
        ]);

        $this->dispatch('toast', 'Contract offer sent!');



    }
}
