<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        $users = User::select('id', 'name', 'email')->where('name', 'LIKE', '%' . $this->search . '%')->paginate(20);

        return view('livewire.admin.users', [
            'users' => $users,
        ])->layout('layouts.admin');
    }

    public function impersonate(User $user)
    {
        session()->put('impersonate', Auth::id());
        Auth::logout();
        Auth::login($user);
        Session::regenerate();

        $this->redirect(route('dashboard'));
    }
}
