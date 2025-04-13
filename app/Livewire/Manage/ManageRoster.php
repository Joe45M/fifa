<?php

namespace App\Livewire\Manage;

use App\Enum\ContractStatus;
use App\Enum\ContractType;
use App\Models\Contract;
use App\Models\User;
use Livewire\Component;

class ManageRoster extends Component
{
    public $players;

    public function render()
    {

        $this->players = auth()->user()->currentContract->club->players;

        return view('livewire.manage.manage-roster')->layout('layouts.manage');
    }

    public function release(Contract $contract)
    {
        $contract->status = ContractStatus::Inactive;
        $contract->save();

        $this->dispatch('toast', 'Player released');
    }

    public function toggleCoManager(Contract $contract)
    {

        if ($contract->type == ContractType::Player) {
            $contract->update([
                'type' => ContractType::CoManager,
            ]);
        } elseif ($contract->type == ContractType::CoManager) {
            $contract->update([
                'type' => ContractType::Player,
            ]);
        }
    }
}
