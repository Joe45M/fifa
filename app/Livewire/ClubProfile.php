<?php

namespace App\Livewire;

use App\Models\Club;
use Livewire\Component;

class ClubProfile extends Component
{
    public $club;

    public function mount(Club $club)
    {
        $this->club = $club;
    }

    public function render()
    {
        return view('livewire.club-profile')->layout('layouts.app');
    }
}
