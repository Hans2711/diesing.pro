<?php

namespace App\Livewire;

use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\User;

class Account extends Component
{
    public $user;
    public $users;

    public $permissions = [
        "tester" => "Tester",
        "notes" => "Notes",
        "redirects" => "Redirects",
        "portfolio" => "Portfolio",
        "cv" => "Cv",
    ];

    private function fillUsers()
    {
        $this->users = User::where("id", "!=", $this->user->id)->get();
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->fillUsers();
    }

    public function logout()
    {
        Auth::logout();
        $this->js("window.location.reload()");
    }

    public function requestAccess($permission)
    {
        $this->user->generatePermissionsToken();
        $this->user->save();

        Mail::to("hp@diesing.pro")->queue(
            new \App\Mail\RequestAccess([
                "user" => $this->user,
                "permission" => $permission,
            ])
        );

        session()->flash("status", __("text.access_request_sent"));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash("status", __("text.user_deleted"));
            $this->fillUsers();
        }
    }

    public function loginUser($id)
    {
        $user = User::find($id);
        if ($user) {
            Auth::login($user);
            $this->js("window.location.reload()");
        }
    }

    public function render()
    {
        return view("livewire.account");
    }
}
