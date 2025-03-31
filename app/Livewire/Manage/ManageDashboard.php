<?php

namespace App\Livewire\Manage;

use Livewire\Component;

class ManageDashboard extends Component
{
    public function render()
    {
        return view('livewire.manage.manage-dashboard')->layout('layouts.manage');
    }
}
