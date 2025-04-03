<?php

namespace App\Livewire\Manage;

use Livewire\Component;

class ManageFixtures extends Component
{
    public function render()
    {
        return view('livewire.manage.manage-fixtures', [
            'fixtures' => auth()->user()->currentContract->club->fixtures,
        ])->layout('layouts.manage');
    }

    public function submit($id)
    {
        $this->redirect(route('manage.submit', $id), true);
    }
}
