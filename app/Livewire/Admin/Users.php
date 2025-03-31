<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{

    use WithPagination;

    public $search;

    public function search()
    {
        return$this->render();
    }

    public function render()
    {
        $users = User::select('name', 'email')->where('name', 'LIKE', '%' . $this->search . '%')->paginate(20);

        return view('livewire.admin.users', [
            'users' => $users,
        ])->layout('layouts.admin');
    }

    public function impersonate(User $user)
    {
        Auth::user()->impersonate($user);

        $this->redirect(route('dashboard'));
    }
}
