<?php

namespace App\Livewire;

use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Account extends Component
{
    public $user;

    public $permissions = [
        "tester" => "Tester",
        "notes" => "Notes",
        "redirects" => "Redirects",
        "portfolio" => "Portfolio",
    ];

    public function mount()
    {
        $this->user = Auth::user();
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

    public function render()
    {
        return view("livewire.account");
    }
}
