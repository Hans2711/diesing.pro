<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountAuth extends Component
{
    public $login;
    public $loginPassword;

    public $username;
    public $email;
    public $name;
    public $registerPassword;
    public $registerPasswordConfirm;

    public $returnUrl;

    public function loginUser()
    {
        if (
            Auth::attempt([
                "email" => $this->login,
                "password" => $this->loginPassword,
            ], true) ||
                Auth::attempt([
                    "username" => $this->login,
                    "password" => $this->loginPassword,
                ], true)
        ) {
            if (empty($this->returnUrl)) {
                $this->js("window.location.reload()");
            } else {
                $this->js("window.location.href = '{$this->returnUrl}'");
            }
        } else {
            session()->flash("error", __("text.invalid_credentials"));
        }
    }

    public function register()
    {
        if ($this->registerPassword != $this->registerPasswordConfirm) {
            session()->flash("error", __("text.passwords_do_not_match"));
            return;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            session()->flash("error", __("text.invalid_email"));
            return;
        }
        if (empty($this->username)) {
            session()->flash("error", __("text.username_empty"));
            return;
        }
        if (empty($this->name)) {
            session()->flash("error", __("text.name_empty"));
            return;
        }
        if (User::where("email", $this->email)->exists()) {
            session()->flash("error", __("text.email_exists"));
            return;
        }

        if (User::where("username", $this->username)->exists()) {
            session()->flash("error", __("text.username_exists"));
            return;
        }

        $user = User::create([
            "username" => $this->username,
            "email" => $this->email,
            "name" => $this->name,
            "password" => bcrypt($this->registerPassword),
        ]);
        $user->save();
        Auth::login($user, $remember = true);
        if (empty($this->returnUrl)) {
            $this->js("window.location.reload()");
        } else {
            $this->js("window.location.href = '{$this->returnUrl}'");
        }
    }

    public function mount($returnUrl = null)
    {
        $this->returnUrl = $returnUrl;

        if (Auth::viaRemember()) {
            if (empty($this->returnUrl)) {
                $this->js("window.location.reload()");
            } else {
                $this->js("window.location.href = '{$this->returnUrl}'");
            }
        }
    }

    public function render()
    {
        return view("livewire.account-auth");
    }
}
