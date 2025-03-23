<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    public $toast = [];

    public function render()
    {
        return view('livewire.toast');
    }

    #[On('toast')]
    public function toast(string $title, string $type = 'success')
    {
        $this->toast[] = collect([
            'title' => $title,
            'type' => $type
        ]);
    }


}
