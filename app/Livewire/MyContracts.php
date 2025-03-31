<?php

namespace App\Livewire;

use App\Enum\ContractStatus;
use App\Enum\ToastType;
use App\Models\Contract;
use Livewire\Component;

class MyContracts extends Component
{
    public $contracts;

    public function acceptOffer(Contract $contract)
    {
        $contract->update([
            'status' => ContractStatus::Active,
        ]);

        $contract->user->contracts()->where('id', '!=', $contract->id)->update([
            'status' => ContractStatus::Inactive,
        ]);

        $this->dispatch('toast', 'Contract accepted!');

        $this->render();
    }

    public function rejectOffer(Contract $contract)
    {
        $contract->update([
            'status' => ContractStatus::Rejected,
        ]);

        $this->dispatch('toast', 'Contract rejected.');

        $this->render();
    }

    public function render()
    {
        $this->contracts = auth()->user()->contracts()->with('club:id,name')->get();

        return view('livewire.my-contracts')->layout('layouts.app');
    }
}
