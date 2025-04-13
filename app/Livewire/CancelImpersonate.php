<?php

namespace App\Livewire;

use Livewire\Component;

class CancelImpersonate extends Component
{
    public function render()
    {
        return view('livewire.cancel-impersonate');
    }


    public function cancel()
    {
        if (session()->has('impersonate')) {
            $user = \App\Models\User::find(session()->get('impersonate'));
            session()->forget('impersonate');
            auth()->logout();
            auth()->login($user);
            session()->regenerate();
        }

        return redirect(route('admin.dashboard'));
    }
}
