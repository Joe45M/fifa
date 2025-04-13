<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{

    public $user;

    public function render()
    {
        $this->user = auth()->user();

        return view('livewire.dashboard')->layout('layouts.app');
    }
}
