<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Portfolio extends Component
{
    public $users = [];
    public $selectedUser;

    public $portfolios = [];

    public function mount()
    {
        $this->users = User::all();

        $this->portfolios = [];
        foreach ($this->users as $user) {
            $this->portfolios[$user->id] = $user->portfolios;
        }
    }

    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->portfolios = [$this->selectedUser->portfolios];
    }

    public function render()
    {
        return view("livewire.portfolio");
    }
}
